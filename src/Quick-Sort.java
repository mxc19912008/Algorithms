public class Quick {

    // This class should not be instantiated.
    private Quick() { }

    /**
     * Rearranges the array in ascending order, using the natural order.
     * @param a the array to be sorted
     */
    //主程序
    public static void sort(Comparable[] a) {
        StdRandom.shuffle(a);
        //洗牌使得input的影响变小
        sort(a, 0, a.length - 1);
        assert isSorted(a);
        //排序后检查
    }

    // quicksort the subarray from a[lo] to a[hi]
    // 副排序
    private static void sort(Comparable[] a, int lo, int hi) { 
        if (hi <= lo) return;
        //纠错输入的lo和hi
        int j = partition(a, lo, hi);
        sort(a, lo, j-1);
        //反复partition前半部分
        sort(a, j+1, hi);
        //反复partition后半部分
        assert isSorted(a, lo, hi);
        //排序后检查
    }

    // partition the subarray a[lo..hi] so that a[lo..j-1] <= a[j] <= a[j+1..hi]
    // and return the index j.
    //以分割点的值为准，左起大于分割点的和右起小于分割点的值对换，直到左右的指针重合或交叉时退出循环；
    //之后将分割点和j对换，此时j因为和i相等或者交错过，是较小值对应的指针。
    private static int partition(Comparable[] a, int lo, int hi) {
        int i = lo;
        int j = hi + 1;
        Comparable v = a[lo];
        while (true) { 

            // find item on lo to swap
            while (less(a[++i], v))
                if (i == hi) break;
            //从第二个元素开始和v比较，如果比v小，继续移动，
            //如果比v大，循环停下，如果到头也没找到，循环也停
            //目的是找到比v大的元素
            // find item on hi to swap
            while (less(v, a[--j]))
                if (j == lo) break;      // redundant since a[lo] acts as sentinel
            //从倒数第一个元素开始和v比较，如果比v大，继续移动，
            //如果比v小，循环停下，如果到头也没找到，循环也停
            //目的是找到比v小的元素
            // check if pointers cross
            if (i >= j) break;
            //左右的指针重合或交叉时退出循环
            //以上都是在找寻需要对换的指针
            exch(a, i, j);
            //左起大于分割点的和右起小于分割点的值对换
        }

        // put partitioning item v at a[j]
        exch(a, lo, j);
        //之后将分割点和j对换，此时j因为和i相等或者交错过，是较小值对应的指针
        // now, a[lo .. j-1] <= a[j] <= a[j+1 .. hi]
        return j;
    }

    public static Comparable select(Comparable[] a, int k) {
        if (k < 0 || k >= a.length) {
            throw new IndexOutOfBoundsException("Selected element out of bounds");
        }
        StdRandom.shuffle(a);
        int lo = 0, hi = a.length - 1;
        while (hi > lo) {
            int i = partition(a, lo, hi);
            if      (i > k) hi = i - 1;
            else if (i < k) lo = i + 1;
            else return a[i];
        }
        return a[lo];
    }
}