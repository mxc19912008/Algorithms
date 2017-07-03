//Binary Search 注意要求a[]是排好序的
Public static int BinarySearch(int a[], key){
	int lo = 0, hi = a.length-1;
	while(lo<=hi){//这里忘记加等于号，原因：还是没有理解为什么要加等于号，没有想到corner cases，例如a={1}的时候
		int mid = lo+(hi-lo)/2;
		if(a[mid]<key) lo = mid+1;
		else if(a[mid]>key) hi = mid -1;
		else return mid; 
	}
	return -1;
}