/*Given a sorted array a[] of n elements, 
  write a function to search a given element x in a[].
  给定一个排好序的数组a[], 
  写一个可以搜索到特定x在a[]中位置的函数
*/
 public static int BinarySearch(int[] a, int key) {
    int lo = 0;
    //定义起始低指针的位置为0；
    int hi = a.length - 1;
    //定义起始高指针的位置为a[]最后一个元素；
    while (lo <= hi) {
    //高低指针不交叉时继续搜索
        int mid = lo + (hi - lo) / 2;
        //定义中指针位置：低指针加上高低指针距离的一半；
        if      (key < a[mid]) hi = mid - 1;
        //因为数组是已经排好序的，所以如果key比中指针值小，
        //那就在更小的一半找key，通过将高指针赋值变成中指针-1；
        else if (key > a[mid]) lo = mid + 1;
        //所以如果key比中指针值大，
        //那就在更大的一半找key，通过将低指针赋值变成中指针+1；
        else return mid;
        //如果不是上述两者，那就是key和中指针值相等，就返回这个值.
        
    return -1;
    //如果循环结束还找不到，那就返回-1.
}