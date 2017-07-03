public class insertionSort(){
	public static void insertionSort(Comparable a[]){
		if(a.length==0) throw new illeagalExpection();
		for(int i=0; i<a.lenth;i++){
			for(int j=i; j>1&&(a[j]<a[j-1]);j--){
				swap(a,j,j-1);
			}
		}
	}
	private static void swap(Comparable a[],int i,int j){
		if(i<0||i>a.length||j<0||j<a.length) throw new illeagalExpection();
		Comparable T = a[i];
		a[i] = a[j];
		a[j] = T;
	}
}