using System;

namespace arrays
{
    class Arrays
    {
        public void getSingleDimensionalArray()
        {   
            int[] array1 = new int[5];
            int[] setArr = new int[10];   
             // Declare and set array element values
            int[] array2 = new int[] { 1, 3, 5, 7, 9 };

            // Alternative syntax
            int[] array3 = { 1, 2, 3, 4, 5, 6 };

            Console.WriteLine("Single Dimensional Array:-");
            for(int i = 0;i < array2.Length;i++)
            {   
                Console.WriteLine("{0}\n", array2[i]);
            } 
        }   

        public void setSingleDimensionalArray()
        {
            int[] setArr1D = new int[50];   
            for (int i = 0;i < 50;i++)
            {
                setArr1D[i] = i;
            }

            for(int i = 0;i < setArr1D.Length;i++)
            {   
                Console.WriteLine("{0}\n", setArr1D[i]);
            } 
        }

        public void setMultiDimensionalArray()
        {
            int[,] setArr2Dor3D = new int[10,1];   
            
            for (int i = 0;i < 10;i++)
            {
                 for (int j = 0;j < 1;j++)
                 {
                    setArr2Dor3D[i, j] = i + 100;
                 }
            }

            for(int i = 0;i < 10;i++)
            { 
                 for (int j = 0;j < 1;j++)
                 {
                    Console.WriteLine("{0}\n", setArr2Dor3D[i, j]);
                 }
            } 
        }

        public void getMultiDimensionalArray()
        {
              // Two-dimensional array.
            int[,] array2D = new int[,] { { 1, 2 }, { 3, 4 }, { 5, 6 }, { 7, 8 } };
            // The same array with dimensions specified.
            int[,] array2Da = new int[4, 2] { { 1, 2 }, { 3, 4 }, { 5, 6 }, { 7, 8 } };
            // A similar array with string elements.
            string[,] array2Db = new string[3, 2] { { "one", "two" }, { "three", "four" },
                                                    { "five", "six" } };

            // Three-dimensional array.
            int[, ,] array3D = new int[,,] { { { 1, 2, 3 }, { 4, 5, 6 } }, 
                                            { { 7, 8, 9 }, { 10, 11, 12 } } };
            // The same array with dimensions specified.
            int[, ,] array3Da = new int[2, 2, 3] { { { 1, 2, 3 }, { 4, 5, 6 } }, 
                                                { { 7, 8, 9 }, { 10, 11, 12 } } };
             Console.WriteLine("Multi 2D-3D Dimensional Array:-");                                    
            // Accessing array elements.
            Console.WriteLine(array2D[0, 0]);
            Console.WriteLine(array2D[0, 1]);
            Console.WriteLine(array2D[1, 0]);
            Console.WriteLine(array2D[1, 1]);
            Console.WriteLine(array2D[3, 0]);
            Console.WriteLine(array2Db[1, 0]);
            Console.WriteLine(array3Da[1, 0, 1]);
            Console.WriteLine(array3D[1, 1, 2]);

            // Getting the total count of elements or the length of a given dimension.
            var allLength = array3D.Length;
            var total = 1;
            for (int i = 0; i < array3D.Rank; i++) {
                /*Get length of array in specified dimension*/
                total *= array3D.GetLength(i);
            }
            Console.WriteLine("{0} equals {1}", allLength, total);

        }
    }

   class MainClass
   {
        static void Main(string[] args)
        {
                   
            Arrays a = new Arrays();
           // a.setSingleDimensionalArray();
             a.setMultiDimensionalArray();
            //a.getSingleDimensionalArray();
           // a.getMultiDimensionalArray();

            
        }
   }

}
