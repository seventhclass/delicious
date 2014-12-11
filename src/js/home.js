window.onload=function(){
	var container=document.getElementById('content_home');
	if (container.style.display == 'none') {return;}
	else{
		var list =document.getElementById('list');
		var buttons =document.getElementById('buttons').getElementsByTagName('span');
		var prev =document.getElementById('prev');
		var next =document.getElementById('next');
		
		 var animated= false;  //优化动画用的变量，点击动画按钮的时候，只有完成了一次操作以后，再按钮才可以继续，这样节省内存
		  var timer;     //自动播放定时器
		  
		var index= 1;           //小圆点-代表第几张图片
		function showButton(){                       //这个功能是为了实现只有一个小圆点是亮的，其他图片小圆点都是关闭状态
			for (var i=0;i< buttons.length;i++){
				if (buttons[i].className== 'on'){
					buttons[i].className= '';
					break;                          //break表示条件满足就跳出循环
				}
			}					 
			buttons[index-1].className='on';
		}
		
		
		function animate(offset) {
				  animated=true;                //true就表示可以允许animate运行
				  var newleft=parseInt(list.style.left)+offset;
				var time=245;  // 实现动画效果：位移总时间
				var interval=5;  //位移间隔时间
				var speed= offset/(time/interval);  //每次位移量
				
				function go(){
					if ((speed<0 && parseInt(list.style.left)> newleft)||(speed>0 && parseInt(list.style.left)< newleft)) {
						list.style.left=parseInt(list.style.left)+speed+'px';
						   setTimeout(go,interval);            //setTimeout一次性动作,但是因为在循环里面，所以会被反复调用，这叫递归。
						}
						else {
							animated=false;
							list.style.left= newleft + 'px';
					 //判断最大最小值， next,prev 按下后，无限滚动：
					 if (newleft>-980){
						list.style.left=-4900+'px';
					 }
					 if (newleft<-4900){
						list.style.left=-980+'px';
					 }
					 
				 }
				}
				go();          //做完判断之后开始运行程序
				
			}
		 function play(){             //自动播放功能
			 timer = setInterval(function() {          //setInterval这个函数会一直执行，而setTimeout这个函数只会执行一次
				next.onclick();
			 },4000);
		 }
		 function stop() {
			clearInterval(timer);
		 }
		 //实现next,prev功能
		 next.onclick= function() {
			if (index==5){
				index=1;
			}
			else {
		  index +=1;     // 这个目的是为实现小圆点功能
		}
		  showButton();  //调用小圆点功能
		  if(!animated){            //(!animated)=(animated=false)
			animate(-980);
		  }
		  
		}
		prev.onclick= function() {
			if (index==1){
				index=5;
			}
			else {
		 index -=1;     // 这个目的是为实现小圆点功能
		}
		  showButton();  //调用小圆点功能
		  if(!animated){
			animate(980);
		  }
		}
		
		 // 点击小圆点，实现图像更换
		 for (var i=0;i< buttons.length;i++) {
			buttons[i].onclick=function() {
				
					// 如果打开的时候已经正好在打开的图片下面，就不再进行其他其余的动作了，目的是在多次点击同一图片的时候，浏览器不再有任何动作。
					if (this.className=='on'){ return;   //return后面的程序就不再跑下去了
					}
					
				var myIndex=parseInt(this.getAttribute('index'));       //Attribute这个函数可以得到自身的位置（模糊理解）
				var offset= -980*(myIndex-index);
				
				
				index=myIndex;
				showButton();
				if(!animated){
					animate(offset);
				}
			}
		}
		 container.onmouseover=stop;    //鼠标放到图片上面，就停止自动播放功能
		 container.onmouseout=play;     //鼠标放到图片外面，就开始自动播放功能
		 play();                       //设置最开始状态为播放状态
	}
}






