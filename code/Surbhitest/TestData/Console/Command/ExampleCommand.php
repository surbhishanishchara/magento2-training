<?php
  namespace Surbhitest\TestData\Console\Command;

  use Symfony\Component\Console\Command\Command;
  use Symfony\Component\Console\Input\{InputInterface, InputArgument, InputOption};
  use Symfony\Component\Console\Output\OutputInterface;

  class ExampleCommand extends Command
  {

    protected function configure()
    {
        parent::configure();
        $this->setName("surbhitest:example:run");
        $this->setDescription("This is my first CLI command");
       // $this->addArgument('is_enable',InputArgument::REQUIRED,'Is Enable');
    //    $this->addArgument('ids',InputArgument::REQUIRED|InputArgument::IS_ARRAY,'Is Enable');
        //$this->addOption('require_msg',null,InputOption::VALUE_REQUIRED,'Require Msg');
        $this->addOption('force',null,InputOption::VALUE_NONE,'Force');
    }

    protected function execute(InputInterface $input,OutputInterface $output )
    {
       /*  $output->writeln("Hey there!!");
        $output->writeln('<info>This is info message</info>');
        $output->writeln('<comment>This is info message</comment>');
        $output->writeln('<error>This is info message</error>');
        $output->writeln('<question>This is info message</question>'); */

        // $is_enable = $input->getArgument('is_enable');
        // $output->writeln($is_enable);

        // $ids = $input->getArgument('ids');
        // $output->writeln($ids);

        //  $Option = $input->getOption('require_msg');
        // $output->writeln($Option);

        if($input->getOption('force')){ //return bool
            $output->writeln("This is forced event");
        }else {
            $output->writeln("This is not forced event"); 
        }

    }
  }

?>