public class MaxPQ<Key extends Comparable<Key>>{
	//MaxPrioirtyQueue定义的是一种数据结构，其中Key extend Comparable
	private Key[] pq;
	private int N;
	//把控queue的size

	public MaxPQ(int capacity){ 
		pq = (Key[]) new Comparable[capacity+1]; 
		//(Key[])是cast，将Comparable变成了extend Comparable的Key（作者说是ugly）
		//Binary heap是从1开始index的，所以capacity要加1.
	}

	public boolean isEmpty(){ 
		return N == 0; 
	}

	public void insert(Key key){
		pq[++N] = key;
		//先将key插到最低点
		swim(N);
		//继而上游(向上找到其合适的位置)
	}

	public Key delMax(){
		Key max = pq[1];
		//最大值就是在最高处(root)的值；
		exch(1, N--);
		//将最大值和最后一个值对换，且将size减小1；
		sink(1);
		//将新换的最高处(root)值sink到其应该在的位置；
		pq[N+1] = null;
		//现在的N已经减了1，所以原来要去掉的位置是N+1，设置为null防止空闲
		return max;
		//将最大值返回
	}
	private void swim(int k){
		while (k > 1 && less(k/2, k)){
			//如果k不是最高node，且k的值比其parent大就继续循环
			exch(k, k/2);
			//如果符合，就交换k和其parent node
			k = k/2;
			//继续向上找(直到k到了最高或者找到比其大的parent)
		}
	}
	private void sink(int k){ 
		while (2*k <= N){
		//向下找2个children(确保有children，即children(2k)在queue内)；
		//为什么不用确保2k+1在queue内？Complete Binary Tree允许最后一排只有一个左枝.
			int j = 2*k;
			if (j < N && less(j, j+1)) j++;
			//找到两个children中较大的那个
				//具体实现的方法是：如果j对应的值大，那么j++就不用执行，指针在左边的child；
				//如果j+1对应的值大，就执行j++，指针就变到了j+1，即2k+1，指针在右边的child.
			if (!less(k, j)) break;
			//如果k(parent)的值不比j(child)的值小，那么断开循环，即不需要交换；
			exch(k, j);
			//否则就要对换k(parent)和j(child)的值
			k = j;
			//将原来parent的指针更新到现在交换过后的child指针，继续向下sink.
		}
	}
	private boolean less(int i, int j){ 
		return pq[i].compareTo(pq[j]) < 0; 
		//注意这里的less是给定指针，对换值的.
	}
	private void exch(int i, int j){ 
		Key t = pq[i]; pq[i] = pq[j]; pq[j] = t; 
		//注意这里的exch是给定指针，对换值的.
	}
}