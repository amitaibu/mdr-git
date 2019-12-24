<?php

namespace App\Command;

use App\Service\GroupMeetingManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class AddMotherToGroupMeeting extends Command
{
    protected static $defaultName = 'app:get-group-meeting-list';

    private $groupMeetingManager;

    public function __construct(GroupMeetingManagerInterface $groupMeetingManager)
    {
        $this->groupMeetingManager = $groupMeetingManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
          ->setDescription('Get listing of a group meeting.')

          // the full command description shown when running the command with
          // the "--help" option
          ->setHelp('Show list of mothers in a group meeting.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');

        $groupMeetings = $this->groupMeetingManager->index();
        $groupMeetingsName = [];
        /** @var \App\Entity\GroupMeeting $groupMeeting */
        foreach ($groupMeetings as $groupMeeting) {
            $groupMeetingsName[$groupMeeting->getFileId()] = $groupMeeting->getName();
        }


        $question = new ChoiceQuestion(
          'Please select a Group meeting',
          $groupMeetingsName
        );
        $question->setErrorMessage('Group meeting %s is invalid.');

        $color = $helper->ask($input, $output, $question);
        $output->writeln('You have just selected: '.$color);

        return 0;
    }
}