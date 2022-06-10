<?php

namespace App\DataFixtures;

use App\Entity\Menu;
use App\Entity\Page;
use App\Entity\Pays;
use App\Entity\Eshop;
use App\Entity\Marque;
use App\Entity\Typehm;
use App\Entity\Couleur;
use App\Entity\Reseaux;
use App\Entity\PageInfo;
use App\Entity\Attributs;
use App\Entity\Carrousel;
use App\Entity\Categories;
use App\Entity\ThemeImage;
use App\Entity\Transporteur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        /* -------------------------------------------------------------------------- */
        /*                            Création des tableaux                           */
        /* -------------------------------------------------------------------------- */

        $marques = [
            'Adidas',
            'Nike',
            'Puma',
            'Reebok',
            'Vans',
            'Coq Sportif',
            'Jordan'
        ];

        $eshops = 'Spotted';

        $categories = [
            'Baskets Basses',
            'Baskets Hautes',
            'Bottes',
            'Tongs',
            'Claquettes/Sandales',
            'Chaussons',
            'T-Shirts',
            'Sweats/Pulls',
            'Blousons/Vestes',
            'Jeans-Pantalons',
            'Joggings',
            'Chemises',
            'Polos',
            'Sous-vêtements',
            'Shorts/Bermudas',
            'Débardeurs',
            'Robes/Jupes',
            'Col',
            'Casquettes',
            'Sacs/Sacoches',
            'Montres',
            'Ceintures',
            'Bracelets',
            'Sacs Bananes',
            'Bonnets',
            'Echarpes/Foulards',
            'Gants',
            'Rayis',
            'Portefeuilles',
        ];

        $typehm = [
            'Homme',
            'Femme',
            'Enfant',
            'Unisexe'
        ];

        $couleur = [
            1 => ['Noir', '#000000'],
            2 => ['Blanc', '#FFFFFF'],
            3 => ['Marron', '#582900'],
            4 => ['Violet', '#EE82EE'],
            5 => ['Rouge', '#F00020'],
            6 => ['Bleu', '#0000FF'],
            7 => ['Vert', '#008000'],
            8 => ['Jaune', '#FFFF00'],
            9 => ['Orange', '#FF7F00'],
            10 => ['Rose', '#FFC0CB'],
            11 => ['Gris', '#808080'],
            12 => ['Or', '#FFD700'],
            13 => ['Argent', '#C0C0C0'],
            14 => ['Marine', '#000080'],
            15 => ['Turquoise', '#40E0D0'],
            16 => ['Ciel', '#87CEEB'],
            17 => ['Indigo', '#4B0082'],
            18 => ['Ocre', '#D2B48C'],
            19 => ['Groseille', '#CF0A1D'],
            20 => ['Thym', '#277F5A'],
            21 => ['Vanille', '#E1CE9A'],
            22 => ['Ecru', '#FEFEE0'],
            23 => ['Rouille', '#985717'],
            24 => ['Bordeaux', '#6D071A'],
            25 => ['Taupe', '#463F32'],
            26 => ['Fauve', '#CC743F'],
            27 => ['Olive', '#708D23'],
            28 => ['Prune', '#811453'],
            29 => ['Anthracite', '#303030'],
            30 => ['Fushia', '#FD3F92'],
            31 => ['Safran', '#E9BD15'],
            32 => ['Aubergine', '#370028'],
            33 => ['Corail', '#FF7F50'],
            34 => ['Cognac', '#bb6144'],
            35 => ['Whisky', '#d29062'],
            36 => ['Saumon', '#f88e55'],
            37 => ['Chocolat', '#5a3a22'],
            38 => ['Framboise', '#c72c48'],
            39 => ['Cuivre', '#b36700'],
        ];


        $carrousel = [
            0 => [
                'Spotted',
                'Une description qui éclate',
                'carrousel',
                'A.webp',
                '1',
                '1',
                '155157'
            ],
            1 => [
                'Spotted',
                'Une description qui éclate',
                'carrousel',
                'B.webp',
                '1',
                '2',
                '533355'
            ],
            2 => [
                'Spotted',
                'Une description qui éclate',
                'carrousel',
                'Z.webp',
                '1',
                '3',
                '1463314'
            ],
        ];

        $transporteur = [
            0 => [
                'Colissimo',
                'Une livraison super rapide',
                '4.99'
            ]
        ];

        $menu = [
            0 => ['Hommes', 1],
            1 => ['Femmes', 2],
            2 => ['Enfants', 3],
        ];

        $reseaux = [
            0 => ['facebook','facebook.png','reseaux','www.facebook.com'],
            1 => ['twitter','twitter.png','reseaux','www.twitter.com'],
            2 => ['instagram','instagram.png','reseaux','www.instagram.com'],
            3 => ['snapchat','snapchat.png','reseaux','www.snapchat.com'],
        ];

        $pageInfo = ['Services Clients', 'Informations Légales'];

        $pages = [
            0 => ['Achat en ligne', 'Achat en ligne','Achat en ligne','Achat en ligne','achat-en-ligne', 'aaaaaaaaa',0],
            1 => ['Paramètres Cookies', 'Paramètres Cookies','Paramètres Cookies','Paramètres Cookies','paramètres-cookies', 'bbbbbbbbb',0],
            2 => ['Politique de confidentitalité', 'Politique de confidentitalité','Politique de confidentitalité','Politique de confidentitalité','politique-de-confidentitalité', 'ccccccccc',0],
        ];

        $pays = [
            0 => ['France', 'france.png', 'france'],
            1 => ['Algérie', 'algerie.png', 'algerie'],
            2 => ['Amérique', 'amerique.png', 'amerique'],
            3 => ['Maroc', 'maroc.png', 'maroc'],
        ];
        /* -------------------------------------------------------------------------- */
        /*                      boucle qui enregistre les données                     */
        /* -------------------------------------------------------------------------- */

        foreach ($marques as $marqueValue) {
            $marque = new Marque();
            $marque->setMarqueNom($marqueValue)
                ->setMarqueDestination($marqueValue);
            $manager->persist($marque);
        }

        $eshop = new Eshop();
        $eshop->setEshopNom($eshops);
        $manager->persist($eshop);

        foreach ($categories as $categorieValue) {
            $categories = new Categories();
            $categories->setCatNom($categorieValue)
                ->setCatEshop($eshop);
            $manager->persist($categories);
        }

        foreach ($typehm as $typehmValue) {
            $typehm = new Typehm();
            $typehm->setTypehmNom($typehmValue);
            $manager->persist($typehm);
        }

        foreach ($couleur as $couleurValue) {
            $couleur = new Couleur();
            $couleur->setCouleurNom($couleurValue[0])
                ->setCouleurValeur($couleurValue[1]);
            $manager->persist($couleur);
        }

        $themeimage = new ThemeImage();
        $themeimage->setImageNom("spotted");
        $themeimage->setImageEntier("spotted.ico");
        $themeimage->setImageDestination("favico");
        $manager->persist($themeimage);

        $themeimage2 = new ThemeImage();
        $themeimage2->setImageNom("spotted");
        $themeimage2->setImageEntier("spotted.png");
        $themeimage2->setImageDestination("logo");
        $manager->persist($themeimage2);

        foreach ($carrousel as $carrouselValue) {
            $carrousel = new Carrousel();
            $carrousel->setCarrouselTitre($carrouselValue[0])
                ->setCarrouselDescription($carrouselValue[1])
                ->setCarrouselDestination($carrouselValue[2])
                ->setCarrouselEntier($carrouselValue[3])
                ->setCarrouselNom($carrouselValue[4])
                ->setCarrouselPosition($carrouselValue[5])
                ->setCarrouselSize($carrouselValue[6]);
            $manager->persist($carrousel);
        }

        foreach ($menu as $menuValue) {
            $menu = new Menu();
            $menu->setMenuNom($menuValue[0])
                ->setMenuPosition($menuValue[1]);
            $manager->persist($menu);
        }

        foreach ($transporteur as $transporteurValue) {
            $transporteur = new Transporteur();
            $transporteur->setTransporteurNom($transporteurValue[0])
                ->setTransporteurDescription($transporteurValue[1])
                ->setTransporteurPrix($transporteurValue[2]);
            $manager->persist($transporteur);
        }

        $attributs = new Attributs();
        $attributs->setAttributNom("couleurs");
        $manager->persist($attributs);

        foreach($reseaux as $reseauxValue){
            $reseaux = new Reseaux();
            $reseaux->setReseauNom($reseauxValue[0])
                ->setReseauEntier($reseauxValue[1])
                ->setReseauDestination($reseauxValue[2])
                ->setReseauLien($reseauxValue[3]);
            $manager->persist($reseaux);
        }

        foreach($pageInfo as $pageInfoValue){
            $pageInfo = new PageInfo();
            $pageInfo->setPageTitre($pageInfoValue);
            $manager->persist($pageInfo);
        }

        foreach($pages as $pageValue){
            $pages = new Page();
            $pages->setPageTitre($pageValue[0])
                ->setPageBaliseTitre($pageValue[1])
                ->setPageMetaDescription($pageValue[2])
                ->setPageMetaCle($pageValue[3])
                ->setPageUrlSimple($pageValue[4])
                ->setPageContenu($pageValue[5])
                ->setPageBloque($pageValue[6])
                ->setPageInfo($pageInfoValue);
            $manager->persist($pages);
        }

        foreach($pays as $paysValue){
            $pays = new Pays();
            $pays->setPaysNom($paysValue[0])
                ->setPaysDrapeau($paysValue[1])
                ->setPaysDestination($paysValue[2]);
            $manager->persist($pays);
        }

        $manager->flush();
    }
}
