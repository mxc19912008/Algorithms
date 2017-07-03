public class MergeBU(){
	private static Comparable[] aux;
	private static void merge(Comparable[] a, Comparable[] aux, int lo, int mid, int hi) {
        //这个merge函数的目的是将一个数组的2段融合且排序
        assert isSorted(a, lo, mid); 
        assert isSorted(a, mid+1, hi);
        //此处的assert相当于if(!isSorted(a, lo, mid)) throw new AssertionError();
        //用于判断前半段和后半段的数组是否是已经排好序的；
        for (int k = lo; k <= hi; k++) {
            aux[k] = a[k]; 
        }
        //将a[]复制到另一个auxiliary(辅助)Array里，此处也可以用Array.copy方法；

        //以下代码块：将aux[]里的元素按照大小排序返回原来的Array a[]；
        int i = lo, j = mid+1;
        //因为是recursively(递归)的，lo和mid及hi的值是sort函数中赋值的。
        for (int k = lo; k <= hi; k++) {
            if      (i > mid)              a[k] = aux[j++];
            //如果i指针变得比mid指针还大，那么说明lo...mid这一段都已遍历且排好序；
            //就可以进行另一段(mid...hi)的遍历和排序了。
            else if (j > hi)               a[k] = aux[i++];
            //如果j指针变得比hi指针还大，那么说明mid...hi这一段都已遍历且排好序；
            //就可以进行另一段(lo...mid)的遍历和排序了。
            else if (less(aux[j], aux[i])) a[k] = aux[j++];
            else                           a[k] = aux[i++];
            //如果非以上2种，即现在两段都是在遍历中，那么选lo...mid和mid...hi两段
            //中更小的那个元素赋值给a[k](待赋值)，并且移动指针。
        }

        assert isSorted(a, lo, hi);
        //排序后的检查
    }
    public static void sort(Comparable[] a){
    	int N = a.length;
    	//简洁，且避免多次access a[];
    	aux = new Comparable[N];
    	for(int sz = 1; sz < N; sz = sz+sz){
    		//size从1开始，遍历所有的(0,1),(1,2)...后，size变成2，而后变成4...最后；
    		for(int lo = 0; lo < N-sz; lo += sz+sz){
    			//increment=sz+sz，lo<N-sz是因为要留出sz的空间供merge；
    			//遍历所有的(0,sz),(sz+1,2)...
    			merge(a,lo,lo+sz-1,Math.min(lo+sz+sz-1,N-1))
    			//看图
    		}
    	}
    }
}