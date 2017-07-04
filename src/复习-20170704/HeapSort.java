//Heap Sort
public static class HeapSort(){
	public static void sort(Comparable a[]){
		int N = a.length;
		//Key pq[] = new Key[N];//注意，heapSort并不依赖于priorityQueue
		for(int k = N/2; k >= 1;k--){//忘记等于号，其实最高点也是需要sink的
			sink(a,k,N);
		}
		while(N>1){
			exch(a,1,N--);
			sink(a,1,N);
		}
	}
	public static void sink(Comparable a[],int k,int N){
		if(k>N||k<1) return;
		//int j = 2*k;
		while(2*k<N){
			int j = 2*k;//在这里写这句比较好，用于循环
			if(j<N&&less(j,j+1)) j++;
			if(!less(k,j)) break;//忘记这句，是用于比较的，如果没有比child小，就不用换
			exch(j,k);
			k = j;
			//j = k*2;
		}
	}
	private static boolean less(Comparable a[],int i, int j){
		return a[i].compareTo(a[j])<0;
	}
	private static void exch(Comparable a[],int i, int j){
		Key t = a[i];
		a[i] = a[j];
		a[j] = t; 
	}
}