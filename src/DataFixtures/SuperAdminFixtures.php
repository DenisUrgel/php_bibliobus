<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SuperAdminFixtures extends Fixture
{


    public function __construct(private UserPasswordHasherInterface $hasher) {
    }
    public function load(ObjectManager $manager): void
    {
        $superAdmin = $this->createSuperAdmin();
        $manager->persist($superAdmin);

        $user = $this->createBaseUser();
        $manager->persist($user);
        
        $manager->flush();
    }

    /**
     * Cette méthode permet de créer le super admin de l'application
     * 
     * @return User
     */
    private function createSuperAdmin(): User{
        $superAdmin = new User();

        $superAdmin->setFirstName('Sirius');
        $superAdmin->setlastName('Black');
        $superAdmin->setFamilyMembers(1);
        $superAdmin->setAddress("06 rue du pape");
        $superAdmin->setCity("Paris");
        $superAdmin->setZipCode("75000");
        $superAdmin->setIsVerified(true);
        $superAdmin->setEmail("suriusblack@gmail.com");
        $superAdmin->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $superAdmin->setIsSubscribed(true);
        $superAdmin->setIsDepositPaid(true);

        $passwordHashed = $this->hasher->hashPassword($superAdmin, "azerty1234A*");
        $superAdmin->setPassword($passwordHashed);
        $superAdmin->setCreatedAt(new DateTimeImmutable());
        $superAdmin->setUpdatedAt(new DateTimeImmutable());

        return $superAdmin;
    }

    private function createBaseUser(): User{
        $BaseUser = new User();

        $BaseUser->setFirstName('Denis');
        $BaseUser->setlastName('Urgel');
        $BaseUser->setFamilyMembers(4);
        $BaseUser->setAddress("8 rue beethoven");
        $BaseUser->setCity("les clayes sous bois");
        $BaseUser->setZipCode("78340");
        $BaseUser->setIsVerified(true);
        $BaseUser->setEmail("denisurgel04@gmail.com");
        $BaseUser->setRoles(['ROLE_USER']);
        $BaseUser->setIsSubscribed(true);
        $BaseUser->setIsDepositPaid(true);

        $passwordHashed = $this->hasher->hashPassword($BaseUser, "azerty1234A*");
        $BaseUser->setPassword($passwordHashed);
        $BaseUser->setCreatedAt(new DateTimeImmutable());
        $BaseUser->setUpdatedAt(new DateTimeImmutable());

        return $BaseUser;
    }
}
