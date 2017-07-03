//QuickSort
public static class QuickSort(){
	public static void sort(Comparable a[]){
		StdRandom.shuffle(a);//忘记洗牌
		int lo=0,hi=a.length-1;
		sort(a,lo,hi);
		assert isSorted(a,lo,hi);
	}
	private static void sort(Comparable a[], int lo, int hi){
		if(hi<= lo) return; //忘记这句
		int mid = partition(a,lo,hi);
		sort(a,lo,mid-1);//注意这里是mid-1
		sort(a,mid+1,hi);
		//assert isSorted(a,lo,mid);
		//assert isSorted(a,mid+1,hi);
		assert isSorted(a,lo,hi);//写成了上面2句，这个函数的主要目的是sort lo...hi
	}
	public static int partition(Comparable a[], int lo, int hi){
		int i = lo+1;
		int j = hi;
		Comparable v = a[lo];//忘记这句
		/*while(true){
			if(i>=j) break;
			if(less(a[j],a[i])) exch(a,i++,j--);
		}*/
		while(true){
			while(less(a[i++],v)){
				if (i == hi) break;
			}
			while(less(v,a[j--])){
				if(j==lo) break;
			}
			if(i>=j) break;
			exch(a,i,j)
		}//还是没有理解到位
		exch(a,j,lo);
		return j;
	}
}