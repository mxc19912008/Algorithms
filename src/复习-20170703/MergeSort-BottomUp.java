//MergeSort Bottom UP 20170703
public class MergeBU(){
	private Comparable[] aux;
	/*public static void Sort(Comparable a[]){
		int lo=0,hi=a.length-1;
		Sort(a,lo,hi);
		assert isSorted(a);
	}*///这个method是多余的
	public static void merge(Comparable a[],int lo, int mid, int hi){
		if(hi<lo) return;
		assert isSorted(a,lo,mid);//忘记，原因：对bottomUp理解有点模糊
		assert isSorted(a,mid,hi);//忘记，原因：对bottomUp理解有点模糊
		int N = a.length;

		for(int i=0; i<N; i++){
			aux[i] = a[i];
		}
		int mid = lo+(hi-lo)/2;
		for(int k=lo; k<=hi; k++){
			if(i>mid) a[k] = aux[j++];
			else if(j<mid) a[k] = aux[i++];
			else if(less(aux[i],aux[j])) a[k] = aux[i++];
			else a[k] = aux[j++];
		}
		assert isSorted(a, lo, hi);//忘记，merge的一个功能是sort
	}
	public static void Sort(Comparable a[]){

		int N = a.length;
		aux = new Comparable(N);
		for(int sz=1; sz<N; sz=sz+sz){
			for(int lo=0; lo<N-sz; lo+=sz+sz){
				merge(a,lo,lo+sz+sz-1,Math.min(lo+sz+sz,N-1));//系数还是有问题，写成了a,lo,lo+sz+sz-1,Math.min(lo+sz+sz,N-1)
			}//应该是a,lo,lo+sz-1,math.min(lo+sz+sz-1,N-1)原因是记错了，应该是(0,0,1),(2,2,3)...这样就是代表了(0,1)(2,3)...
		}
		assert isSorted(a,lo,hi);
	}
	public static boolean isSorted(Comparable a[],int lo, int hi){
		if(hi<lo) return;
		for(i=lo;i<hi-1;i++){
			if(a[i]>a[i+1]) return false;
		}
		return true;
	}
	public static boolean less(Comparable v,Comparable w){
		return v.compareTo(w)<0;
	}
}
