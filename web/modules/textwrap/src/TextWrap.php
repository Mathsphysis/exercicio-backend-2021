<?php

namespace Drupal\textwrap;

/**
 * Implemente sua resolução nessa classe.
 *
 * Depois disso:
 * - [ ] Crie um PR no github com seu código
 * - [ ] Veja o resultado da correção automática do seu código
 * - [ ] Commit até os testes passarem
 * - [ ] Passou tudo, melhore a cobertura dos testes
 * - [ ] Ficou satisfeito, envie seu exercício para a gente! <3
 *
 * Boa sorte :D
 */
class TextWrap implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */
  public function wrap(string $text, int $length): array {
    
    if(empty($text) || $length == 0){
      return [""];
    }

    $resultArray = array();

    $buildingArray = explode(" ", trim($text));

    $key = 0;

    mb_internal_encoding('UTF-8');

    foreach($buildingArray as $word){
      if(empty($resultArray[$key])){
        $resultArray[$key] = $word;
      } elseif(mb_strlen($resultArray[$key]) + mb_strlen($word) < $length) {
        $resultArray[$key] .= ' ' . $word;
      } elseif(mb_strlen($word) <= $length) {
        $resultArray[++$key] = $word;
      } else{
        $charsLeft = $word;
        do{
          if(mb_strlen($charsLeft) < $length){
            $resultArray[++$key] = $charsLeft;
            unset($charsLeft);
            continue;
          }
          var_dump($resultArray);
          $subword = substr($charsLeft, 0, $length);
          var_dump("charsleft: " . $charsLeft . "| subword" . $subword);
          $charsLeft = substr($charsLeft, $length);
          $resultArray[++$key] = $subword;
        }while(!empty($charsLeft));
      }
     }
    
    return $resultArray;
  }

}
