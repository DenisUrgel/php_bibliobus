<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\BookCollection;
use App\Entity\Collections;
use App\Entity\Publisher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création des éditeurs
        $publisher1 = new Publisher;
        $publisher1->setName('magnard');
        $manager->persist($publisher1);

        $publisher2 = new Publisher;
        $publisher2->setName('Belin éducation');
        $manager->persist($publisher2);

        // Création des collections
        $collection1 = new Collections();
        $collection1->setName('bac');
        $collection1->setPublisherId('1');
        $manager->persist($collection1);

        $collection2 = new Collections();
        $collection2->setName('Déclic : vous allez aimer lire !');
        $collection2->setPublisherId('2');
        $manager->persist($collection2);

        // Création des auteurs
        $auteur1 = new Author();
        $auteur1->setName('Molière');
        $manager->persist($auteur1);

        $auteur2 = new Author();
        $auteur2->setName('Victor Hugo');
        $manager->persist($auteur2);

        // Création des livres
        $livre1 = new Book();
        $livre1->setTitle('Le malade imaginaire');
        $livre1->setCategorie('roman');
        $livre1->setSummary('Le Malade imaginaire met en scène Argan, riche bourgeois se croyant constamment atteint de maladies terribles. Il adule tous les médecins qui pourraient lui apporter quelque remède, à tel point qu\'il est décidé à marier sa fille Angélique à l\'un d\'entre e');
        $livre1->setImage('https://media.electre-ng.com/images/image-id/205bb49fcc60080ed6613128de75f3e650fd3b900ede05b17b914f028735a9b6.jpg');
        $livre1->setAuteurId($auteur1);
        $livre1->setCopiesAvailable(1);
        $manager->persist($livre1);

        $livre2 = new Book();
        $livre2->setTitle('Les misérables');
        $livre2->setCategorie('aventure');
        $livre2->setSummary(' Stéphane, tout juste arrivé de Cherbourg, intègre la Brigade Anti-Criminalité de Montfermeil, dans le 93. Il va faire la rencontre de ses nouveaux coéquipiers, Chris et Gwada, deux "Bacqueux" d\'expérience. Il découvre rapidement les tensions entre les di');
        $livre2->setImage('https://media.e.leclerc/9791035826857_1?op_sharpen=1&resmode=bilin&fmt=pjpeg&qlt=85&trim=0.5&wid=450&fit=fit,1&hei=450');
        $livre2->setAuteurId($auteur2);
        $livre2->setCopiesAvailable(1);
        $manager->persist($livre2);

        // Création des book_collections
        $bookColl1 = new BookCollection();
        $bookColl1->setBookId($livre1);
        $bookColl1->setCollectionId($collection1);
        $manager->persist($bookColl1);
        
        $bookColl2 = new BookCollection();
        $bookColl2->setBookId($livre2);
        $bookColl2->setCollectionId($collection2);
        $manager->persist($bookColl2);

        $manager->flush();
    }
}
