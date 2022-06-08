<?php

namespace App\Admin\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    /***********************
     * Attributes
     **********************/
    
    /**
     * @var array
     */
    const COLORS = [
        'KNRM' => "\x1B[0m",
        'KRED' => "\x1B[31m",
        'KGRN' => "\x1B[32m",
        'KYEL' => "\x1B[33m",
        'KBLU' => "\x1B[34m",
        'KMAG' => "\x1B[35m",
        'KCYN' => "\x1B[36m",
        'KWHT' => "\x1B[37m",
    ];

    /** 
     * @var string
     */
    const FILE_NAME = __DIR__.'/../../public/upload/Exception.log';

    /** 
     * @var resource|false
     */
    private $handle; 

    /***********************
     * Accessors
     **********************/

    /** 
     * @param resource|false $handle
     * @return self
     */
    private function setHandle(&$handle): self
    {
        $this->handle = $handle;

        return $this;
    }

    /** 
     * @return resource|false $handle
     */
    private function getHandle()
    {
        return $this->handle;
    } 

    public function getColors(): array
    {
        return self::COLORS;
    }

    /***********************
     * Methods
     **********************/

    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            KernelEvents::EXCEPTION => [
                ['processException', 10],
                ['logException', 0],
                ['notifyException', -10],
            ],
        ];
    }

    public function notifyException(ExceptionEvent $event)
    { 
    }

    public function logException(ExceptionEvent $event): void
    {  
        // Ouverture du ficher
        if (!file_exists(self::FILE_NAME)) {
            \touch(self::FILE_NAME); 
        }

        $handle = \fopen(self::FILE_NAME, 'r+');
        $this->setHandle($handle);
        if ( false === $this->getHandle() ) {
            return; 
        }

        // Construction du message
        $throwable = $event->getThrowable(); 
        $currentM  = $throwable->getMessage();
        $length    = \strlen($currentM);
        $date      = new \DateTime();
        $message   = PHP_EOL;
        $message   .= '-------------------------------------------------------------------------------------------------------------------';
        $message   .= PHP_EOL.$this->getColors()['KGRN'].'Le '.$date->format('Y/m/d à H:i:s');
        $message   .= PHP_EOL.$this->getColors()['KRED'].'Information'.$this->getColors()['KNRM'].
                      ' : erreur à la ligne '.(string) $throwable->getLine().
                      ' du fichier '.$throwable->getFile();

        // Construction d'un message lisible avec retour à la ligne
        for ($i = 0; $i < $length; $i++) {
            if ($i%115 === 0) {
                for ($j = $i; $j >= 0; $j--) {
                    if (' ' === $currentM[$j]) {
                        $currentM[$j] = PHP_EOL;
                        break;
                    }
                }
            }
        }

        $message   .= PHP_EOL.$this->getColors()['KRED'].'Message'.$this->getColors()['KNRM'].
                      ' : '.$currentM.PHP_EOL;
        $message   .= '-------------------------------------------------------------------------------------------------------------------';
        $message   .= PHP_EOL;

        // Vérification du contenu et suppression si besoin
        $row       = '';
        $count     = 0;
        while ( false !== ($row = \fgets($this->getHandle())) ) {  
            if ( \preg_match('/^-{10,}.*$/', $row) ) {
                $count++;
            }
        }
    
        // Si plus de 30 lignes on réinitialise le fichier
        if ( $count === 0 || $count/2 >= 500 ) {
            $header = PHP_EOL.$this->getColors()['KCYN'];
            $header .= '|==============================================|'.PHP_EOL.
                       '|                                              |'.PHP_EOL.
                       '| GESTION DES LOGS REMONTES PAR LES EXCEPTIONS |'.PHP_EOL.
                       '|                                              |'.PHP_EOL.
                       '|==============================================|'.PHP_EOL;
            
            $header .= $this->getColors()['KNRM'].PHP_EOL;

            // Suppression du contenu et écriture du header 
            \file_put_contents(self::FILE_NAME, '', LOCK_EX);
            \rewind($this->getHandle());
            \fwrite($this->getHandle(), $header);
        }
        
        // Ecriture du message 
        \fseek($this->getHandle(), -1, SEEK_END);
        \fwrite($this->getHandle(), $message );

        // Fermeture du ficher
        \fclose($this->getHandle());
    }

    public function processException(ExceptionEvent $event)
    {
    }
}