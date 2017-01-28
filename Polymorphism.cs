using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Polymorphism
{
    /*Polymorphism*/
    class Shape
    {
        protected int poly_width, poly_height;

        public Shape(int a = 0, int b = 0)
        {
            poly_width = a;
            poly_height = b;
        }

        public virtual int area()
        {
            Console.WriteLine("Parent class area :");
            return 0;
        }
    }

    class Rectangle : Shape
    {
        public Rectangle(int a = 0, int b = 0)
            : base(a, b)
        {

        }
        public override int area()
        {
            Console.WriteLine("Rectangle class area :");
            return (poly_width * poly_height);
        }
    }
    class Triangle : Shape
    {
        public Triangle(int a = 0, int b = 0)
            : base(a, b)
        {

        }
        public override int area()
        {
            Console.WriteLine("Triangle class area :");
            return (poly_width * poly_height / 2);
        }
    }
    class Caller
    {
        public void CallArea(Shape sh)
        {
            int a;
            a = sh.area();
            Console.WriteLine("Area: {0}", a);
        }
    }  
}
