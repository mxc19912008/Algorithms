public class HeapSort{
	public static void sort(Comparable[] a){
		int N = a.length;
		//长度
		for (int k = N/2; k >= 1; k--){
			sink(a, k, N);
		}
		//第一部分，将无序的array构建成ordered-heap(最大的在index=1);
		//找到N的parent(k = N/2)，将其下沉，然后找k的左枝继续下沉...
		//为什么要从k = n/2开始下沉？因为这是第一个可以下沉的元素。
		while (N > 1){
			exch(a, 1, N);
			sink(a, 1, --N);
		}
		//第二部分，将ordered-heap变成最小值在index=1的increasing sorted array
		//具体的方法是，将最大(index=1)和最后(index=N)对换后，再将最后的值sink回去，这样最大的就到了最后
		//因为最后的已经是最大，不用重复排序，所以N--；
		//继续loop，直到N=2。每次仅剩的最大值放在最后，有些类似selection sort(最小值放在最前)
	}
	private static void sink(Comparable[] a, int k, int N){
		while (2*k <= N){
			//向下找2个children(确保有children，即children(2k)在queue内)；
			//为什么不用确保2k+1在queue内？Complete Binary Tree允许最后一排只有一个左枝.
			int j = 2*k;
			if (j < N && less(j, j+1)) j++;
			//找到两个children中较大的那个
				//具体实现的方法是：如果j对应的值大，那么j++就不用执行，指针在左边的child；
				//如果j+1对应的值大，就执行j++，指针就变到了j+1，即2k+1，指针在右边的child.
			if (!less(k, j)) break;
			//如果k(parent)的值不比j(child)的值小，那么断开循环，即不需要交换；
			exch(k, j);
			//否则就要对换k(parent)和j(child)的值
			k = j;
			//将原来parent的指针更新到现在交换过后的child指针，继续向下sink.
		}
	}
	private static boolean less(Comparable[] a, int i, int j){
		return a[i].compareTo(a[j]) < 0; 
		//注意这里的less是给定指针，对换值的.
	}
	private static void exch(Comparable[] a, int i, int j){
		Key t = a[i]; a[i] = a[j]; a[j] = t; 
		//注意这里的exch是给定指针，对换值的. 
	}
}