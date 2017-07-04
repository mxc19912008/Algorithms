//Priority Queues
public static class MaxPQ <Key extends <Comparable key>>(){
	private Key[] pq;
	private int N;
	public MaxPQ(int capacity){
		pq = (Key[]) new Comparable[capacity+1];//忘写[]，cast的是一个数组，而不是Key
		N = 0;
	}
	public boolean isEmpty(){ 
		return N == 0; 
	}
	public static void swim(int k){
		while(k>1&&less(k/2,k)){
			exch(k,k/2);
			k=k/2;
		}
	}
	public static void sink(int k){
		if(k>N||k<1) return;
		
		while(2*k<N){
			int j = 2*k;
			if(j<N&&less(j,j+1)) j++;
			if(!less(k,j)) break;
			exch(j,k);
			k = j;
			j = k*2;
		}

	}
	public static void insert(Key key){
		pq[++N] = key;//注意这里是++N，先增加N，再赋值；
		swim(N);
	}
	public static Key delMax(Key key){
		Key max = pq[1];
		exch(1,N--);
		pq[N+1]=null;
		return max;
	}
	private static boolean less(int i, int j){
		return pq[i].compareTo(pq[j])<0;
	}
	private static void exch(int i, int j){
		Key t = pq[i];
		pq[i] = pq[j];
		pq[j] = t; 
	}
}