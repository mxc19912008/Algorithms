
public class Merge {

    private Merge() { }

    // 以下是mergeSort的主method: sort
    public static void sort(Comparable[] a) {
        Comparable[] aux = new Comparable[a.length];
        //Comparable是一个interface，必须有compareTo方法(如何进行比较);
        //此处是一个Comparable的Array，这样做的目的是使得任意规定了compareTo方法的data type，
        //都可以用mergesort进行排序，比如int Array和String Array就都可以；
        sort(a, aux, 0, a.length-1);
        //call的是下面的private sort
        assert isSorted(a);
        //排序后的检查
    }
    // 以下是mergeSort的private method sort
    private static void sort(Comparable[] a, Comparable[] aux, int lo, int hi) {
        if (hi <= lo) return;
        //用于参数debug的检查；
        int mid = lo + (hi - lo) / 2;
        //定义mid指针位置：lo指针加上hi指针与lo指针距离的一半；
        sort(a, aux, lo, mid);
        //先sort lo...mid一半；
        sort(a, aux, mid + 1, hi);
        //再sort mid...hi的一半；
        merge(a, aux, lo, mid, hi);
        //sort后merge起来(按大小)
        //注意这里的sort是call self(recursively)
        //例子见图片
    }
    //以下是mergeSort的主要部分：merge
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

    


    /**
     * Rearranges the array in ascending order, using the natural order.
     * @param a the array to be sorted
     */



   /***************************************************************************
    *  Helper sorting function.
    ***************************************************************************/
    
    // is v < w ?
    private static boolean less(Comparable v, Comparable w) {
        return v.compareTo(w) < 0;
    }
        
   /***************************************************************************
    *  Check if array is sorted - useful for debugging.
    ***************************************************************************/
    private static boolean isSorted(Comparable[] a) {
        return isSorted(a, 0, a.length - 1);
    }

    private static boolean isSorted(Comparable[] a, int lo, int hi) {
        for (int i = lo + 1; i <= hi; i++)
            if (less(a[i], a[i-1])) return false;
        return true;
    }
