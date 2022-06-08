<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Ajoute/Modifie/Supprime un fichier dans l'application
 * 
 * https://symfony.com/doc/4.4/controller/upload_file.html
 */
class FileUploader
{
    public function __construct(private mixed $targetDirectory, private Filesystem $fileSystem)
    {
    }

    /**
     * Ajoute un fichier dans l'application et retour le nom du fichier
     */
    public function upload(UploadedFile $file, string $path): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $fileName = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

        $file->move($this->getTargetDirectory() . $path, $fileName);

        return $fileName;
    }

    /**
     * Ajoute un fichier dans l'application
     */
    public function add(UploadedFile $file, string $path): string
    {
        return $this->upload($file, $path);
    }


    /**
     * Ajoute un nouveau fichier dans l'application et supprime l'ancien
     *
     * @param UploadedFile|null $file
     * Le fichier à ajouter
     * @param string $getEntity
     * Le nom du fichier à supprimer
     * @param string $path
     * Chemin du fichier à supprimer
     * 
     * @return void|string
     */
    public function update(
        ?UploadedFile $file,
        string $getEntity,
        string $path
    ): string {

        if ($file !== null) {
            $name = $this->upload($file, $path);
            $this->remove($getEntity, $path);
            return $name;
        } else {
            return $getEntity;
        }
    }

    /**
     * Supprime un fichier de l'application
     *
     * @param string $getEntity
     * Le nom du fichier à supprimer
     * @param string $path
     * Chemin du fichier à supprimer
     * 
     * @return void
     */
    public function remove(string $getEntity, string $path): void
    {
        $this->fileSystem->remove($this->getTargetDirectory() . $path . $getEntity);
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
