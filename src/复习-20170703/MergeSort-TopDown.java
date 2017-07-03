//Merge-Sort Top-Down
public class MergeTD(){

	private Comparable aux[];

	Public static void Sort(Comparable a[]){
		int N = a.length;
		aux = new Comparable[N];
		Sort(a,lo,mid,hi);
		assert isSorted(a,lo,hi);//忘写这句了
	}
	private static void Sort(Comparable a[], int lo, int hi){
		assert isSorted(a,lo,mid);
		assert isSorted(a,mid+1,hi);

		if(hi<lo) return;
		int mid = lo+(hi-lo)/2;
		Sort(a,lo,mid);
		Sort(a,mid+1,hi);
		merge(a,lo,mid,hi);

		assert isSorted(a,lo,hi);
	}
	private static void merge(Comparable a[], int lo, int mid, int hi){
		if(hi<lo) return;
		for(int i=lo; i<hi; i++){//给aux赋值弄错地方了，原因是没理解aux的作用，是在merge的时候起的。
			aux[i] = a[i];
		}
		//int lo=0,hi=N-1;//这里也是多写了一句，原因是没有理解各个参数存在的意义。
		int i=lo,j=mid+1;//这里j写成hi-1了，原因是没有理解最核心的地方，i和j的位置移动，而是尽快填好空缺。
		for(int k=lo; k<hi;k++){//这里k写成0-a.length了，原因是没有理解各个参数存在的意义。
			if(i>mid) a[k] = aux[j++];//这里i的条件写成i<lo了，原因是没有理解i的移动动向和限制条件。
			else if(j<mid) a[k] = aux[i++];//这里j的条件写成j>hi了，原因是没有理解i的移动动向和限制条件。
			else if(less(aux[i],aux[j])) a[k] = aux[i++];//这里aux[i],aux[j]写成a[i],a[j]了，原因是没有理解aux才是参照大小的Array
			else a[k] = aux[j++];
		}
	}
	private static boolean isSorted(Comparable a[], int lo, int hi){
		for(int i=lo; i<=hi-1; i++){
			if(a[i]>a[i+1]) return false;
		}
		return true;
	}
	private static boolean less(Comparable(v), Comparable(w)){
		return v.CompareTo(w)<0; //忘写<0了，原因是没有理解这个函数的作用是判断v是不是小于w
	}
}