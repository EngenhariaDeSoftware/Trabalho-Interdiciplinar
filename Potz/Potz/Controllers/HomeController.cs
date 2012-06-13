using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;

namespace Potz.Controllers
{
  public class HomeController : Controller
  {
    public static List<int> ListaNumerosInseridos = new List<int>();
    public ActionResult Index()
    {
      return View();
    }

    public ActionResult Potz()
    {
      ViewBag.NumPotz = 0;
      return View();
    }

    [HttpPost]
    public ActionResult Potz(string PotzNum)
    {
      //Maior que 0 - Retorna o número de Potz caso seja
      //valido
      //Remove o - se tiver
      PotzNum = PotzNum.Replace("-", "");

      ViewBag.NumPotz = VerificarPotz.verificarPotzValido(PotzNum);

      //Caso ja foi inserido esse valor, retorna erro
      if(ViewBag.NumPotz > -1)
        if (ListaNumerosInseridos.Contains(ViewBag.NumPotz))
          ViewBag.NumPotz = -1;
      else
          ListaNumerosInseridos.Add(ViewBag.NumPotz);

      return View();
    }
  }        
}
