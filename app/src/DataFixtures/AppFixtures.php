<?php

namespace App\DataFixtures;

use App\Entity\Child;
use App\Entity\GroupMeeting;
use App\Entity\GroupMeetingAttendance;
use App\Entity\Mother;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create();

        // Create group meetings.
        $groupMeetings = [];
        for ($i = 0; $i < 3; $i++) {
            $groupMeeting = new GroupMeeting();
            $groupMeeting->setName($faker->city . ' ' . $faker->word);
            $groupMeeting->setDate($faker->dateTime);

            $manager->persist($groupMeeting);
            $groupMeetings[] = $groupMeeting;
        }

        // Create Mothers and children.
        $mothers = [];
        for ($i = 0; $i < 100; $i++) {
            $mother = new Mother();
            $mother->setFirstName($faker->firstNameFemale);
            $mother->setLastName($faker->lastName);
            $mother->setBirthdayEstimated(False);

            for ($j = 0; $j < 3; $j++) {
                $child = new Child();
                $child->setFirstName($faker->firstNameFemale);
                $child->setLastName($faker->lastName);
                $child->setMother($mother);

                $groupMeetingAttendance = new GroupMeetingAttendance();
                $groupMeetingAttendance->setPerson($mother);
                $groupMeetingAttendance->setGroupMeeting($groupMeetings[0]);

                $manager->persist($child);
            }

            $manager->persist($mother);
            $mothers[] = $mother;
        }

        // Create group meetings attendance list.
        $counter = 0;
        foreach ($mothers as $mother) {
            $groupMeetingAttendance = new GroupMeetingAttendance();
            $groupMeetingAttendance->setPerson($mother);
            $groupMeetingAttendance->setGroupMeeting($groupMeetings[$counter]);

            $counter++;
            if ($counter >= count($groupMeetings)) {
                $counter = 0;
            }

            $manager->persist($groupMeetingAttendance);
        }

        $manager->flush();
    }
}
