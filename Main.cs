using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Polymorphism;

namespace OOPS
{
    class Book
    {
        public string title;
        public string author;
        public int pages;

        public Book()  
        {  
            // Add code here  
        }

        public string getTitle()
        {
            return "A Great Book";
        }

        public string getAuthor()
        {
            return "John Doe";
        }

        public int turnPage()
        {
            // pointer to next page
            return 1;
        }

        public void printCurrentPage() 
        {
           Console.WriteLine("current page content");
        }
    }

    class LibraryMap
    {
        public int shelfNumber;
        public int roomNumber;
           
           public string findBookBy(string title, string author)
           {
               string location = Convert.ToString(shelfNumber) + ',' + Convert.ToString(roomNumber);
               return location;
           }
    }

    class BookLocator 
    {
        public string locate(Book book) {
            // returns the position in the library
            // ie. shelf number & room number
            LibraryMap lm = new LibraryMap();
            return lm.findBookBy(book.getTitle(), book.getAuthor());
        }
    }

    interface Printer {
                
          void printPage(int page);
    }
 
    class PlainTextPrinter : Printer {
 
        public void printPage(int page) {
           Console.WriteLine(page);
        }
 
    }
 
    class HtmlPrinter : Printer {
 
        public void printPage(int page) {
            Console.WriteLine("<div style='single-page'>" + page + "</div>");
        }

    }

    class EntryPoint
    {

        public static void Main(string[] args)
        {
            Book b = new Book();
            //To assign values to properties during the class instantiation process, use object initializers:
            Book b1 = new Book { title ="C# OOPS", author = "Akeel", pages = 100  };

            b.title = "C# OOPs";
            Console.WriteLine(b.title);

            /*Inheritance */
            Rectangle Rect = new Rectangle();
            int area;
            Rect.setWidth(5);
            Rect.setHeight(7);
            area = Rect.getArea();

            // Print the area of the object.
            Console.WriteLine("Total area: {0}", Rect.getArea());
            Console.WriteLine("Total paint cost: ${0}", Rect.getCost(area));
            


            /*Polymorphism*/
            Caller c = new Caller();
            Polymorphism.Rectangle r = new Polymorphism.Rectangle(10, 7);
            Polymorphism.Triangle t = new Polymorphism.Triangle(10, 5);
            c.CallArea(r);
            c.CallArea(t);
            Console.ReadKey();
        }
    }

}
