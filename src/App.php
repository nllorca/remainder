<?php

namespace Remainder;

use Remainder\RemainderSolver\Contracts\SolverInterface;
use Remainder\DataStream\Input\Contracts\InputInterface;
use Remainder\DataStream\Output\Contracts\OutputInterface;
use Remainder\RemainderSolver\SimpleSolver;
use Remainder\DataStream\Input\CommandLineInput;
use Remainder\DataStream\Output\CommandLineOutput;

class App
{
    private InputInterface $input;
    private OutputInterface $output;
    private SolverInterface $solver;

    public function __construct()
    {
        //Default implementation
        $this->input = new CommandLineInput();
        $this->output = new CommandLineOutput();
        $this->solver = new SimpleSolver();
    }

    public function setInput(InputInterface $input): self
    {
        $this->input = $input;
        return $this;
    }

    public function setOutput(OutputInterface $output): self
    {
        $this->output = $output;
        return $this;
    }

    public function setSolver(SolverInterface $solver): self
    {
        $this->solver = $solver;
        return $this;
    }

    public function run(): void
    {
        try {
            $data = $this->input->getInputData();

            $results = [];

            /** @var $parametersVo Parameters */
            foreach ($data as $parametersVo) {
                $results[] = $this->solver->solve($parametersVo->getX(), $parametersVo->getY(), $parametersVo->getN());
            }

            $this->output->sendOutputData($results);
        } catch (\Exception $e) {
            $this->output->sendOutputError($e->getMessage());
        }
    }
}
