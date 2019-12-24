<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class AddMotherToGroupMeeting extends Command
{
    protected static $defaultName = 'app:add-mother-to-group-meeting';

    protected function configure()
    {
        $this
          ->setDescription('Add a mother to a group meeting.')

          // the full command description shown when running the command with
          // the "--help" option
          ->setHelp('Add existing mothers to an existing group meeting.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
          'Please select your favorite color (defaults to red)',
          ['red', 'blue', 'yellow'],
          0
        );
        $question->setErrorMessage('Color %s is invalid.');

        $color = $helper->ask($input, $output, $question);
        $output->writeln('You have just selected: '.$color);

        return 0;
    }
}