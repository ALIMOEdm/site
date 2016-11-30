<?php

namespace AppBundle\DQL;

use Doctrine\ORM\Query\AST\InputParameter;
use Doctrine\ORM\Query\AST\LikeExpression;
use Doctrine\ORM\Query\AST\NullComparisonExpression;
use Doctrine\ORM\Query\AST\QuantifiedExpression;
use Doctrine\ORM\Query\Lexer;

class IfExpression extends \Doctrine\ORM\Query\AST\Functions\FunctionNode{

    public $firstDateExpression = null;
    public $secondDateExpression = null;
    public $thirdDateExpression = null;
    public $unit = null;
    public $result = array();

    public function parse(\Doctrine\ORM\Query\Parser $parser, $isOrAnd=false)
    {
        if($parser->getLexer()->isNextToken(Lexer::T_IDENTIFIER) && strtoupper($parser->getLexer()->lookahead['value']) == 'IF'){
//            var_dump($parser->getLexer()->lookahead['value']);
            $parser->match(Lexer::T_IDENTIFIER);
            $this->result[] = ' IF ';
//            var_dump($parser->getLexer()->lookahead['value']);
            $parser->match(Lexer::T_OPEN_PARENTHESIS);
            $this->result[] = ' ( ';
        }


//        var_dump($parser->getLexer()->lookahead['value']);
        $stringExpr = $parser->StringExpression();


        $not = false;

        if ($parser->getLexer()->isNextToken(Lexer::T_NOT)) {
            $parser->match(Lexer::T_NOT);
            $not = true;
        }


//        var_dump($parser->getLexer()->lookahead['value']);
        //If next like
        if($parser->getLexer()->isNextToken(Lexer::T_LIKE)) {
            $parser->match(Lexer::T_LIKE);
            if ($parser->getLexer()->isNextToken(Lexer::T_INPUT_PARAMETER)) {
                $parser->match(Lexer::T_INPUT_PARAMETER);
                $stringPattern = new InputParameter($parser->getLexer()->token['value']);
            } else {
                $stringPattern = $parser->StringPrimary();
            }

            $escapeChar = null;

            if ($parser->getLexer()->lookahead['type'] === Lexer::T_ESCAPE) {
                $parser->match(Lexer::T_ESCAPE);
                $parser->match(Lexer::T_STRING);
                $escapeChar = $parser->getLexer()->token['value'];
            }

            $likeExpr = new LikeExpression($stringExpr, $stringPattern, $escapeChar);
            $likeExpr->not = $not;

            $this->result[] = $likeExpr;
        }else
            //IS NULL
            if($parser->getLexer()->isNextToken(Lexer::T_IS)){
                $nullCompExpr = new NullComparisonExpression($stringExpr);
                $parser->match(Lexer::T_IS);

                if ($parser->getLexer()->isNextToken(Lexer::T_NOT)) {
                    $parser->match(Lexer::T_NOT);
                    $nullCompExpr->not = true;
                }
                $parser->match(Lexer::T_NULL);

                $this->result[] = $nullCompExpr;
            }
            else{
//            var_dump($parser->getLexer()->lookahead, '80');
                $comp = $this->compationOper($parser);
                if($comp){
                    $this->result[] = $stringExpr;
                    $this->result[] = $comp;
                    $this->result[] = $parser->ArithmeticPrimary();
                }
            }

        //OR
        if($parser->getLexer()->isNextToken(Lexer::T_OR)){
//            var_dump($parser->getLexer()->lookahead['value'], '91');
            $parser->match(Lexer::T_OR);
            $this->result[] = ' OR ';

            $this->parse($parser, true);

//            $stringExpr = $parser->StringExpression();
//
//            $not = false;
//
//            if ($parser->getLexer()->isNextToken(Lexer::T_NOT)) {
//                $parser->match(Lexer::T_NOT);
//                $not = true;
//            }
//
//            $parser->match(Lexer::T_LIKE);
//            if ($parser->getLexer()->isNextToken(Lexer::T_INPUT_PARAMETER)) {
//                $parser->match(Lexer::T_INPUT_PARAMETER);
//                $stringPattern = new InputParameter($parser->getLexer()->token['value']);
//            } else {
//                $stringPattern = $parser->StringPrimary();
//            }
//
//            $escapeChar = null;
//
//            if ($parser->getLexer()->lookahead['type'] === Lexer::T_ESCAPE) {
//                $parser->match(Lexer::T_ESCAPE);
//                $parser->match(Lexer::T_STRING);
//                $escapeChar = $parser->getLexer()->token['value'];
//            }
//
//            $likeExpr = new LikeExpression($stringExpr, $stringPattern, $escapeChar);
//            $likeExpr->not = $not;
//
//            $this->result[] = $likeExpr;
        }

        if($isOrAnd){
            return;
        }

//        var_dump($parser->getLexer()->lookahead['value'], '129');
        $parser->match(Lexer::T_COMMA);
        $this->result[] = ', ';

        if($parser->getLexer()->isNextToken(Lexer::T_IDENTIFIER) && strtoupper($parser->getLexer()->lookahead['value']) == 'IF'){
            $this->parse($parser);
        }
        else{
//            var_dump($parser->getLexer()->lookahead['value'], '137');
            $this->result[] = $parser->ArithmeticPrimary();

            $comp = $this->compationOper($parser);
            if($comp){
                $this->result[] = $comp;
                $this->result[] = $parser->ArithmeticPrimary();
            }
        }


//        var_dump($parser->getLexer()->lookahead['value'], '147');
        $parser->match(Lexer::T_COMMA);
        $this->result[] = ', ';

//        var_dump($parser->getLexer()->lookahead['value'], '151');
        if($parser->getLexer()->isNextToken(Lexer::T_IDENTIFIER) && strtoupper($parser->getLexer()->lookahead['value']) == 'IF'){
            $this->parse($parser);
        } else{

            $this->result[] = $parser->ArithmeticPrimary();
            $comp = $this->compationOper($parser);
            if($comp){
                $this->result[] = $comp;
                $this->result[] = $parser->ArithmeticPrimary();
            }


        }
//        var_dump($parser->getLexer()->lookahead['value'], '165');
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
        $this->result[] = ' ) ';

//        var_dump($parser->getLexer()->lookahead);
//        var_dump('1111111111111');
//        $this->printT();

    }


    public function compationOper($parser){
        switch ($parser->getLexer()->lookahead['value']) {
            case '=':
                $parser->match(Lexer::T_EQUALS);

                return '=';

            case '<':
                $parser->match(Lexer::T_LOWER_THAN);
                $operator = '<';

                if ($parser->getLexer()->isNextToken(Lexer::T_EQUALS)) {
                    $parser->match(Lexer::T_EQUALS);
                    $operator .= '=';
                } else if ($parser->getLexer()->isNextToken(Lexer::T_GREATER_THAN)) {
                    $parser->match(Lexer::T_GREATER_THAN);
                    $operator .= '>';
                }

                return $operator;

            case '>':
                $parser->match(Lexer::T_GREATER_THAN);
                $operator = '>';

                if ($parser->getLexer()->isNextToken(Lexer::T_EQUALS)) {
                    $parser->match(Lexer::T_EQUALS);
                    $operator .= '=';
                }

                return $operator;

            case '!':
                $parser->match(Lexer::T_NEGATE);
                $parser->match(Lexer::T_EQUALS);

                return '<>';

            default:
                return false;
        }
    }


    public function printT(){
        $arr = $this->result;
        while(true){
            $per =  array_shift($arr);
            if(is_null($per)){
                break;
            }
            if(is_object($per)){
                var_dump($per);
            }else{
                var_dump($per);
            }
        }

    }
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        $str = '';
        while(true){
            $per =  array_shift($this->result);
            if(is_null($per)){
                break;
            }
            if(is_object($per)){
                $str .= ' '.$per->dispatch($sqlWalker).' ';
            }else{
                $str .= $per;
            }
        }
        return $str;
    }
}