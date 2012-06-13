using Potz;
using Microsoft.VisualStudio.TestTools.UnitTesting;
using System;
using Microsoft.VisualStudio.TestTools.UnitTesting.Web;

namespace TestProject1
{
    
    [TestClass()]
    public class VerificarPotzTest
    {


        private TestContext testContextInstance;

        public TestContext TestContext
        {
            get
            {
                return testContextInstance;
            }
            set
            {
                testContextInstance = value;
            }
        }

        #region Additional test attributes
        // 
        //You can use the following additional attributes as you write your tests:
        //
        //Use ClassInitialize to run code before running the first test in the class
        //[ClassInitialize()]
        //public static void MyClassInitialize(TestContext testContext)
        //{
        //}
        //
        //Use ClassCleanup to run code after all tests in a class have run
        //[ClassCleanup()]
        //public static void MyClassCleanup()
        //{
        //}
        //
        //Use TestInitialize to run code before running each test
        //[TestInitialize()]
        //public void MyTestInitialize()
        //{
        //}
        //
        //Use TestCleanup to run code after each test has run
        //[TestCleanup()]
        //public void MyTestCleanup()
        //{
        //}
        //
        #endregion

        //TDD 1
        [TestMethod()]
        public void verificarPotzValidoTest0()
        {
            Assert.AreEqual(VerificarPotz.verificarPotzValido("0"), 1);
        }

        //TDD 2
        [TestMethod()]
        public void verificarPotzValidoTest1()
        {
            Assert.AreEqual(VerificarPotz.verificarPotzValido("1"), 1);
        }
        //TDD 3
        [TestMethod()]
        public void verificarPotzValidoTest2()
        {
            Assert.AreEqual(VerificarPotz.verificarPotzValido(""), -1);
        }

        //TDD 4
        [TestMethod()]
        public void verificarPotzValidoNegativo3()
        {
            Assert.AreEqual(VerificarPotz.verificarPotzValido(""),-1);
        }

        //TDD - 5
        [TestMethod()]
        public void verificarPotzValidoTest4()
        {
            Assert.AreEqual(VerificarPotz.verificarPotzValido("500564321-0"), 1);
        }

        //TDD - 5 
        [TestMethod()]
        public void verificarPotzValidoTest5()
        {
            Assert.AreEqual(VerificarPotz.verificarPotzValido(""), -1);
        }

        //TDD - 6
        [TestMethod()]
        public void verificarPotzValidoTest6()
        {
            Assert.AreEqual(VerificarPotz.verificarPotzValido(""), 1);
        }

        //TDD - 7
       
        [TestMethod()]
        public void verificarPotzValidoTest7()
        {
            Assert.AreEqual(VerificarPotz.verificarPotzValido("50012345-0"), -1);
        }

        //TDD - 7

        [TestMethod()]
        public void verificarPotzValidoTest8()
        {
            Assert.AreEqual(VerificarPotz.verificarPotzValido("0"), -1);
        }
    }
}
