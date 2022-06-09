<?php


namespace App\Services;


use App\Entity\Personne;
use Doctrine\Common\Persistence\ObjectManager;

class AleatoireService
{
    public function generateRandomString($length = 5, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function  remplirRandom(ObjectManager $manager, $sec) {
//        $random = random_int(1, 10);
//        $random2 = random_bytes(10);
         for ($i=1 ; $i<=10;$i++) {
            $personne= new Personne();
            $personne->setNom($this->generateRandomString())
                ->setPrenom($this->generateRandomString())
                ->setAge(rand(1,60))
                ->setAdresse($this->generateRandomString());
            $manager->persist($personne);
             $manager->flush();
             sleep($sec);
        }
        }



}