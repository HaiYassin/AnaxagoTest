<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 12/07/18
 * Time: 17:33
 */

namespace Anaxago\CoreBundle\DataFixtures\ORM;

use Anaxago\CoreBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $investor = self::getUserInvestor();
        $admin = self::getUserInvestor();

        $manager->persist($investor);
        $manager->persist($admin);

        $manager->flush();
    }

    public static function getUserInvestor()
    {
        $investor = (new User())
            ->setFirstName('John')
            ->setLastName('Doe')
            ->setEmail('john@local.com')
            ->setPlainPassword('john');

        return $investor;
    }

    public static function getUserAdmin()
    {
        $admin = (new User())
            ->setFirstName('admin')
            ->setLastName('anaxago')
            ->setEmail('admin@local.com')
            // because we like security
            ->setPlainPassword('admin')
            ->addRoles('ROLE_ADMIN')
        ;

        return $admin;
    }
}
