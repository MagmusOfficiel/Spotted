<?php

namespace App\DataFixtures;

use Attribute;
use App\Entity\Menu;
use App\Entity\Marque;
use App\Entity\Typehm;
use App\Entity\Couleur;
use App\Entity\Produit;
use App\Entity\Attributs;
use App\Entity\Carrousel;
use App\Entity\Categories;
use App\Entity\ThemeImage;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $marque1 = new Marque();
        $marque1->setMarqueNom("Nike");
        $marque1->setMarqueDestination("Nike");
        $manager->persist($marque1);

        $marque2 = new Marque();
        $marque2->setMarqueNom("Puma");
        $marque2->setMarqueDestination("Puma");
        $manager->persist($marque2);

        $marque3 = new Marque();
        $marque3->setMarqueNom("Adidas");
        $marque3->setMarqueDestination("Adidas");
        $manager->persist($marque3);

        $marque4 = new Marque();
        $marque4->setMarqueNom("Air-Jordan");
        $marque4->setMarqueDestination("Air-Jordan");
        $manager->persist($marque4);

        $modele1 = new Categories();
        $modele1->setCatNom("Baskets Basses");
        $manager->persist($modele1);

        $modele2 = new Categories();
        $modele2->setCatNom("Baskets Montantes");
        $manager->persist($modele2);

        $modele3 = new Categories();
        $modele3->setCatNom("Bottes");
        $manager->persist($modele3);

        $modele4 = new Categories();
        $modele4->setCatNom("Chaussure basique");
        $manager->persist($modele1);

        $modele5 = new Categories();
        $modele5->setCatNom("Tongs");
        $manager->persist($modele5);

        $modele6 = new Categories();
        $modele6->setCatNom("Claquettes/Sandales");
        $manager->persist($modele6);

        $modele7 = new Categories();
        $modele7->setCatNom("Chaussons");
        $manager->persist($modele7);

        $modele8 = new Categories();
        $modele8->setCatNom("T-Shirts");
        $manager->persist($modele8);

        $modele9 = new Categories();
        $modele9->setCatNom("Sweats/Pulls");
        $manager->persist($modele9);

        $modele10 = new Categories();
        $modele10->setCatNom("Blousons/Vestes");
        $manager->persist($modele10);

        $modele11 = new Categories();
        $modele11->setCatNom("Jeans-Pantalons");
        $manager->persist($modele11);

        $modele12 = new Categories();
        $modele12->setCatNom("Joggings");
        $manager->persist($modele12);

        $modele13 = new Categories();
        $modele13->setCatNom("Chemises");
        $manager->persist($modele13);

        $modele14 = new Categories();
        $modele14->setCatNom("Polos");
        $manager->persist($modele14);

        $modele15 = new Categories();
        $modele15->setCatNom("Sous-vêtements");
        $manager->persist($modele15);

        $modele16 = new Categories();
        $modele16->setCatNom("Shorts-Bermudas");
        $manager->persist($modele16);

        $modele17 = new Categories();
        $modele17->setCatNom("Débardeurs");
        $manager->persist($modele17);

        $modele18 = new Categories();
        $modele18->setCatNom("Robes-Jupes");
        $manager->persist($modele18);

        $modele19 = new Categories();
        $modele19->setCatNom("Col");
        $manager->persist($modele19);

        $modele20 = new Categories();
        $modele20->setCatNom("Casquettes");
        $manager->persist($modele20);

        $modele21 = new Categories();
        $modele21->setCatNom("Sacs/Sacoches");
        $manager->persist($modele21);

        $modele22 = new Categories();
        $modele22->setCatNom("Montres");
        $manager->persist($modele22);

        $modele23 = new Categories();
        $modele23->setCatNom("Ceintures");
        $manager->persist($modele23);

        $modele24 = new Categories();
        $modele24->setCatNom("Bracelets");
        $manager->persist($modele24);

        $modele25 = new Categories();
        $modele25->setCatNom("Sacs Bananes");
        $manager->persist($modele25);

        $modele26 = new Categories();
        $modele26->setCatNom("Bonnets");
        $manager->persist($modele26);

        $modele27 = new Categories();
        $modele27->setCatNom("Echarpes/Foulards");
        $manager->persist($modele27);

        $modele28 = new Categories();
        $modele28->setCatNom("Gants");
        $manager->persist($modele28);

        $modele29 = new Categories();
        $modele29->setCatNom("Rayis");
        $manager->persist($modele29);

        $modele30 = new Categories();
        $modele30->setCatNom("Portefeuilles");
        $manager->persist($modele30);

        $typehm1 = new Typehm();
        $typehm1->setTypehmNom("Homme");
        $manager->persist($typehm1);

        $typehm2 = new Typehm();
        $typehm2->setTypehmNom("Femme");
        $manager->persist($typehm2);

        $typehm3 = new Typehm();
        $typehm3->setTypehmNom("Enfants");
        $manager->persist($typehm3);

        $typehm4 = new Typehm();
        $typehm4->setTypehmNom("Unisexe");
        $manager->persist($typehm4);

        $couleur = new Couleur();
        $couleur->setcouleurNom("Noir");
        $couleur->setcouleurValeur("#000000");
        $manager->persist($couleur);

        $couleur1 = new Couleur();
        $couleur1->setcouleurNom("Marron");
        $couleur1->setcouleurValeur("#582900");
        $manager->persist($couleur1);

        $couleur2 = new Couleur();
        $couleur2->setcouleurNom("Rouge");
        $couleur2->setcouleurValeur("#f00020");
        $manager->persist($couleur2);

        $couleur3 = new Couleur();
        $couleur3->setcouleurNom("Orange");
        $couleur3->setcouleurValeur("#ff7f00");
        $manager->persist($couleur3);

        $couleur4 = new Couleur();
        $couleur4->setcouleurNom("Jaune");
        $couleur4->setcouleurValeur("#ffff00");
        $manager->persist($couleur4);

        $couleur5 = new Couleur();
        $couleur5->setcouleurNom("Vert");
        $couleur5->setcouleurValeur("#008000");
        $manager->persist($couleur5);

        $couleur6 = new Couleur();
        $couleur6->setcouleurNom("Bleu");
        $couleur6->setcouleurValeur("#0000FF");
        $manager->persist($couleur6);

        $couleur7 = new Couleur();
        $couleur7->setcouleurNom("Violet");
        $couleur7->setcouleurValeur("#EE82EE");
        $manager->persist($couleur7);

        $couleur8 = new Couleur();
        $couleur8->setcouleurNom("Gris");
        $couleur8->setcouleurValeur("#808080");
        $manager->persist($couleur8);

        $couleur9 = new Couleur();
        $couleur9->setcouleurNom("Blanc");
        $couleur9->setcouleurValeur("#FFFFFF");
        $manager->persist($couleur9);

        $couleur10 = new Couleur();
        $couleur10->setcouleurNom("Or");
        $couleur10->setcouleurValeur("#FFD700");
        $manager->persist($couleur10);

        $couleur11 = new Couleur();
        $couleur11->setcouleurNom("Argent");
        $couleur11->setcouleurValeur("#C0C0C0");
        $manager->persist($couleur11);

        $couleur12 = new Couleur();
        $couleur12->setcouleurNom("Rose");
        $couleur12->setcouleurValeur("#FFC0CB");
        $manager->persist($couleur12);

        $couleur13 = new Couleur();
        $couleur13->setcouleurNom("Marine");
        $couleur13->setcouleurValeur("#000080");
        $manager->persist($couleur13);

        $couleur14 = new Couleur();
        $couleur14->setcouleurNom("Turquoise");
        $couleur14->setcouleurValeur("#40E0D0");
        $manager->persist($couleur14);

        $couleur15 = new Couleur();
        $couleur15->setcouleurNom("Ciel");
        $couleur15->setcouleurValeur("#87CEEB");
        $manager->persist($couleur15);

        $couleur16 = new Couleur();
        $couleur16->setcouleurNom("Indigo");
        $couleur16->setcouleurValeur("#4B0082");
        $manager->persist($couleur16);

        $couleur17 = new Couleur();
        $couleur17->setcouleurNom("Ocre");
        $couleur17->setcouleurValeur("#D2B48C");
        $manager->persist($couleur17);

        $couleur18 = new Couleur();
        $couleur18->setcouleurNom("Groseille");
        $couleur18->setcouleurValeur("#cf0a1d");
        $manager->persist($couleur18);

        $couleur19 = new Couleur();
        $couleur19->setcouleurNom("Thym");
        $couleur19->setcouleurValeur("#277f5a");
        $manager->persist($couleur19);

        $couleur20 = new Couleur();
        $couleur20->setcouleurNom("Vanille");
        $couleur20->setcouleurValeur("#e1ce9a");
        $manager->persist($couleur20);

        $couleur21 = new Couleur();
        $couleur21->setcouleurNom("Ecru");
        $couleur21->setcouleurValeur("#fefee0");
        $manager->persist($couleur21);

        $couleur22 = new Couleur();
        $couleur22->setcouleurNom("Rouille");
        $couleur22->setcouleurValeur("#985717");
        $manager->persist($couleur22);

        $couleur23 = new Couleur();
        $couleur23->setcouleurNom("Bordeaux");
        $couleur23->setcouleurValeur("#6d071a");
        $manager->persist($couleur23);

        $couleur24 = new Couleur();
        $couleur24->setcouleurNom("Taupe");
        $couleur24->setcouleurValeur("#463f32");
        $manager->persist($couleur24);

        $couleur25 = new Couleur();
        $couleur25->setcouleurNom("Fauve");
        $couleur25->setcouleurValeur("#cc743f");
        $manager->persist($couleur25);

        $couleur26 = new Couleur();
        $couleur26->setcouleurNom("Olive");
        $couleur26->setcouleurValeur("#708d23");
        $manager->persist($couleur26);

        $couleur27 = new Couleur();
        $couleur27->setcouleurNom("Prune");
        $couleur27->setcouleurValeur("#811453");
        $manager->persist($couleur27);

        $couleur28 = new Couleur();
        $couleur28->setcouleurNom("Anthracite");
        $couleur28->setcouleurValeur("#303030");
        $manager->persist($couleur28);

        $couleur29 = new Couleur();
        $couleur29->setcouleurNom("Fushia");
        $couleur29->setcouleurValeur("#fd3f92");
        $manager->persist($couleur29);

        $couleur30 = new Couleur();
        $couleur30->setcouleurNom("Safran");
        $couleur30->setcouleurValeur("#e9bd15");
        $manager->persist($couleur30);

        $couleur31 = new Couleur();
        $couleur31->setcouleurNom("Aubergine");
        $couleur31->setcouleurValeur("#370028");
        $manager->persist($couleur31);

        $couleur32 = new Couleur();
        $couleur32->setcouleurNom("Corail");
        $couleur32->setcouleurValeur("#FF7F50");
        $manager->persist($couleur32);

        $couleur33 = new Couleur();
        $couleur33->setcouleurNom("Cognac");
        $couleur33->setcouleurValeur("#bb6144");
        $manager->persist($couleur33);

        $couleur34 = new Couleur();
        $couleur34->setcouleurNom("Whisky");
        $couleur34->setcouleurValeur("#d29062");
        $manager->persist($couleur34);

        $couleur35 = new Couleur();
        $couleur35->setcouleurNom("Saumon");
        $couleur35->setcouleurValeur("#f88e55");
        $manager->persist($couleur35);

        $couleur36 = new Couleur();
        $couleur36->setcouleurNom("Chocolat");
        $couleur36->setcouleurValeur("#5a3a22");
        $manager->persist($couleur36);

        $couleur37 = new Couleur();
        $couleur37->setcouleurNom("Framboise");
        $couleur37->setcouleurValeur("#c72c48");
        $manager->persist($couleur37);

        $couleur38 = new Couleur();
        $couleur38->setcouleurNom("Cuivre");
        $couleur38->setcouleurValeur("#b36700");
        $manager->persist($couleur38);

        $couleur39 = new Couleur();
        $couleur39->setcouleurNom("Multicolore");
        $couleur39->setcouleurValeur("#ffffff");
        $manager->persist($couleur39);

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

        $carrousel = new Carrousel();
        $carrousel->setCarrouselTitre("Spotted");
        $carrousel->setCarrouselDescription("Une description qui éclate"); 
        $carrousel->setCarrouselDestination("carrousel"); 
        $carrousel->setCarrouselEntier("carrouselspot.png");
        $carrousel->setCarrouselNom("carrouselspot");
        $carrousel->setCarrouselPosition("1");
        $carrousel->setCarrouselSize("155157"); 
        $manager->persist($carrousel);

        $carrousel2 = new Carrousel();
        $carrousel2->setCarrouselTitre("Spotted");
        $carrousel2->setCarrouselDescription("Une description qui éclate"); 
        $carrousel2->setCarrouselDestination("carrousel"); 
        $carrousel2->setCarrouselEntier("peuimport.png");
        $carrousel2->setCarrouselNom("peuimport");
        $carrousel2->setCarrouselPosition("2");
        $carrousel2->setCarrouselSize("533355");
        $manager->persist($carrousel2);

        $carrousel3 = new Carrousel();
        $carrousel3->setCarrouselTitre("Spotted");
        $carrousel3->setCarrouselDescription("Une description qui éclate"); 
        $carrousel3->setCarrouselDestination("carrousel"); 
        $carrousel3->setCarrouselEntier("dzadaz.png");
        $carrousel3->setCarrouselNom("dzadaz");
        $carrousel3->setCarrouselPosition("3");
        $carrousel3->setCarrouselSize("1463314");
        $manager->persist($carrousel3);

        $menu = new Menu();
        $menu->setMenuNom("Hommes");
        $menu->setMenuPosition("1");
        $manager->persist($menu);

        $menu1 = new Menu();
        $menu1->setMenuNom("Femmes");
        $menu1->setMenuPosition("2");
        $manager->persist($menu1);

        $menu2 = new Menu();
        $menu2->setMenuNom("Enfants");
        $menu2->setMenuPosition("3");
        $manager->persist($menu2);

        $menu3 = new Menu();
        $menu3->setMenuNom("Nouveautés");
        $menu3->setMenuPosition("4");
        $manager->persist($menu3);

        $menu4 = new Menu();
        $menu4->setMenuNom("PROMOTION");
        $menu4->setMenuPosition("5");
        $manager->persist($menu4);

        $attributs = new Attributs();
        $attributs->setAttributNom("couleurs");
        $manager->persist($attributs);

        $manager->flush();
 
    }
}
