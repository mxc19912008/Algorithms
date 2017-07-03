public class Insertion{
	public static void sort(Comparable[] a){ // Sort a[] into increasing order.
		int N = a.length;
		for (int i = 1; i < N; i++){ // Insert a[i] among a[i-1], a[i-2], a[i-3]... ..
		//i指针移动，代表一个将要左移比较的基准
			for (int j = i; j > 0 && less(a[j], a[j-1]); j--) exch(a, j, j-1);
			//j指针在i指针的基础上左移，如果发现比j的值小的，就交换，
			//直到都是i指针左侧都是按从小到大排，退出循环
		}
	}
// See page 245 for less(), exch(), isSorted(), and main().
}