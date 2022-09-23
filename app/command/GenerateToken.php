<?php

namespace app\command;

use app\model\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;


class GenerateToken extends Command
{
    protected static $defaultName = 'wt:generate-token';
    protected static $defaultDescription = '快速为用户生成 token';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('id', InputArgument::REQUIRED, '用户 ID');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');

        $user = User::find($id);

        if (!$user) {
            $output->writeln('用户不存在');
            return self::FAILURE;
        }

        $output->writeln(jwt_encode(['id' => $id]));
        return self::SUCCESS;
    }

}
