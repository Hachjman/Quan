using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using System;
using System.Collections.Generic;

namespace _123
{
    internal class Program
    {
        static void Main(string[] args)
        {
            List<Student> studentList = new List<Student>
            {
                new Student(1, "Nguyen Van Anh", 15),
                new Student(2, "Nguyễn Văn Ba", 17),
                new Student(3, "Nguyễn Văn Co", 14),
                new Student(4, "Nguyễn Văn Dien", 19),
                new Student(5, "Nguyễn Văn Tien", 16),
            };

            // Câu 1: In danh sách học sinh
            Console.WriteLine("Danh sách học sinh:");
            foreach (var student in studentList)
            {
                Console.WriteLine(student);
            }

            // Câu 2: Học sinh từ 16 tuổi trở lên
            Console.WriteLine("\nHọc sinh từ 16 tuổi trở lên:");
            var olderStudents = studentList.Where(s => s.Age >= 16).ToList();
            foreach (var student in olderStudents)
            {
                Console.WriteLine(student);
            }

            // Câu 3: Học sinh có tên bắt đầu bằng chữ 'A'
            Console.WriteLine("\nHọc sinh có tên bắt đầu bằng chữ 'A':");
            var studentsStartingWithA = studentList.Where(s => s.Name.StartsWith("A", StringComparison.OrdinalIgnoreCase)).ToList();
            foreach (var student in studentsStartingWithA)
            {
                Console.WriteLine(student);
            }
            //Câu 4 : Tính tổng tuổi các học sinh 
            var totalAge = studentList.Sum(s => s.Age);
            Console.WriteLine($"\nTổng số tuổi của các học sinh: {totalAge}");
            //Câu 5: Sắp xếp theo tuổi 
            Console.WriteLine("\nDanh sách học sinh sắp xếp theo tuổi (tăng dần):");
            var sortedByAge = studentList.OrderBy(s => s.Age).ToList();
            foreach (var student in sortedByAge)
            {
                Console.WriteLine(student);
            }
        }
    }
}
