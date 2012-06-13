using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Potz
{
  public static class VerificarPotz
  {
    //--------------------------TDD------------------------------
    //PASSOS

        //--------------------------TDD------------------------------
        //------   1    --------------------------------------------
        //Sem implementação
        //public static int verificarPotzValido(string PotzNum)
        //{
        //    throw new NotImplementedException();
        //}

        //--------------------------TDD------------------------------
        //------   2    --------------------------------------------
        //Sempre retornando 1 para qualquer valor
       //public static int verificarPotzValido(string PotzNum)
      //{
      //    return 1;
      //}

        //--------------------------TDD------------------------------
        //------   3    --------------------------------------------
        //Verifica se ele é preenchido, se sim
        //mesmo com letras, retorna 1
          //public static int verificarpotzvalido(string potznum)
          //{
          //    if (potznum.length > 0)
          //        return 1;
          //    else
          //        return -1;
          //}

        //--------------------------TDD------------------------------
        //------   4    --------------------------------------------
        //Verifica se ele é preenchido, se sim
        //mesmo com numeros negativos, retorna 1
      //public static int verificarPotzValidoNegativo(string PotzNum)
      //{
      //    if (PotzNum.Length > 0)
      //        return 1;
      //    else
      //        return -1;
      //}

        //--------------------------TDD------------------------------
        //------   5    --------------------------------------------
        //Verificando a quantidade de digitos, se inferior à
        //6 digitos a direita + 1 digito verificador ou maior que 10 retorna
        //0, -1, indicando erro
      //public static int verificarPotzValido(string PotzNum)
      //{
      //    char[] PotzArray = PotzNum.ToCharArray();
      //    Array.Reverse(PotzArray);
      //    string PotzInvertido = new String(PotzArray);

      //    if (PotzInvertido.Length > 7 || PotzInvertido.Length > 10)
      //        return 1;
      //    else
      //        return -1;
      //}

        //--------------------------TDD------------------------------
        //------   6    --------------------------------------------
        //Verificando se os digitos são números
      //public static int verificarPotzValido(string PotzNum)
      //{
      //    char[] PotzArray = PotzNum.ToCharArray();
      //    Array.Reverse(PotzArray);
      //    string PotzInvertido = new String(PotzArray);

      //    if (PotzInvertido.Length > 7 || PotzInvertido.Length > 10)
      //    {
      //        foreach (char letra in PotzInvertido)
      //            if (letra < 48 || letra > 57)
      //                return -1;
      //    }
      //    else
      //        return -1;

      //    return 1;
      //}


        //--------------------------TDD------------------------------
        //------   7    --------------------------------------------
        //Verificando se o número Potz é um número válido com  
        //modulo 11
      public static int verificarPotzValido(string PotzNum)
      {
          char[] PotzArray = PotzNum.ToCharArray();
          Array.Reverse(PotzArray);
          string PotzInvertido = new String(PotzArray);

          if (PotzInvertido.Length > 7 && PotzInvertido.Length < 11 && PotzInvertido.Length != 0)
          {
              foreach (char letra in PotzInvertido)
                  if (letra < 48 || letra > 57)
                      return -1;
          }
          else
              return -1;


          string PotzNumMod11 = PotzInvertido.Substring(0, 7);
          int numSoma = 0;
          int charIndex = 1;
          for (int mult = 2; mult <= 7; mult++)
          {
              numSoma += int.Parse(PotzNumMod11[charIndex].ToString()) * mult;
              charIndex++;
          }
          if (((numSoma * 10) % 11) != int.Parse(PotzNumMod11[0].ToString()))
              return -1;

          char[] retornoPotzArray = PotzInvertido.Substring(7).ToCharArray();
          Array.Reverse(retornoPotzArray);
          int retornoPotzInvertido = int.Parse(new String(retornoPotzArray));

          return retornoPotzInvertido;
      } 
  }

  public class TesteVerificarPotz
  {
    public void Teste()
    {
      string numPotz = "500564321-0";
      numPotz = numPotz.Replace("-", "");
      int qtdPotz = 0;

      qtdPotz = VerificarPotz.verificarPotzValido(numPotz);

      string retorno;
      if (qtdPotz > 1)
        retorno = string.Concat("Número Potz Válido. Qtd = {0}", qtdPotz);
      else
        retorno = "Número Potz inválido";

    }
  }

}