<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\Article;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
 

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class AppFixtures extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $userPasswordEncoder;

    //Affectation du userpassword
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder){
        $this->userPasswordEncoder = $userPasswordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        //RAPPEL :: operateur de resolution de portee pour appeler les elements d'une classe et non d'un objet.
        $faker = Factory::create();

        //Creation de 10 utilisateurs
        For ($i=0 ; $i < 10 ; $i++){
             
            $user = new User();

            //Mot de pass different 1.genere un hash 2.setter cet email ds le user crée par chainage.
            $passHash = $this->userPasswordEncoder->encodePassword($user,'password');
            $user->setEmail($faker->email)
                 ->setPassword($passHash);

            if ($i % 3 === 0) {
                $user->setStatus(false)
                     ->setAge(23);
            }


            //On persiste en base de donné sinon n'existe pas.
            $manager->persist($user);

            //Chaque utilisateur cree entre 5 et 15 articles. Relation author
            For ($j=0 ; $j < random_int(5,15) ; $j++){

                //(nA) vas permettre de chainer donc evite $article->setX()
                $article = (new Article())
                    ->setAuthor($user)
                    ->setContent($faker->text($maxNbChars = 200))
                    ->setName($faker->lastName);

                //On persit a la fin de la création.
                $manager->persist($article);
            }     
        }
        $manager->flush();
    }
}

