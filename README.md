需要修复的bug:
(done)	1. home slider:当数据库中只有一张图片时，图片无法显示
		2. detail页小图片数量 >4 时有问题，前后导航按钮不起作用
(done)	3. promotion页小图片数量 >4 时通过左右箭头移动
(done)	4. 用于生成验证码的字体文件更换为体积较小的文件
(done)	5. menu页左侧分类导航最后一行底边border应去掉
(done)	6. promotion页dish的link弹出菜品详情
(done)	7. menu页左侧分类导航的小三角定位要求每个分类的行高相等（文字已垂直居中）
		8. 网站字体如何能够不依赖于本机
(done)	9. menu页菜品高度为显示18（3×6）个菜品。

～ 2015.1.6 ～

本阶段待完成的工作如下：
		About Us页增加社交媒体图标及样式编辑
			（建议使用字体图标制作，易维护）
(done)	Menu页分类导航条的position控制
			(基于目前gallery高度固定，分类数目不变的情况下直接将position=fixed即可，将来如有需要，可改为js实现)
(done)	Menu页分页样式编辑（首页，上一页，下一页，尾页，可用字体图标）
(done)	Menu页分类导航条左侧的小三角位置的移动控制(js)
(done)	Promotion页样式完善 
(done)	Promotion页图片显示，多图片间的切换（js控制渐入渐出）
(done)	Detail页多图片间的切换（js控制渐入渐出）

下一阶段待完成的工作如下：
(done)	加Logo（需要小马提供）
		首页slider上添加暂停/播放按钮，文字说明等，动画调整
(done)	menu页右侧部分高度调整为自适应
		Detail页直接跳转到前一个或后一个菜品，增加店家推荐标志
		Detail页thumbnail导航标签更换
		网站所用图标尽可能更换为字体图标，以便于今后样式修改和维护
		侧边栏的社交媒体图标
		Promotion页分页
		多语言支持
		代码整理、优化
=========
delicious restaurant

0. 头和尾(header & footer)
	增加logo
	社交媒体做成侧边栏
	
1. 首页（home)
	图片滑动速度由匀速改为先快后慢。
	图片数量改为可变。
	前后箭头，圆按钮等还可以适当美化。
	增加图片描述
	
2. 菜品页(menu)
	菜品列表数据库操作。
	分页。
	详情弹出层结构及样式。
	
3. 促销页(promotions)
	css样式美化。
	弹层显示促销菜品详情，同菜品页详情弹层。

4. 关于我们(about us)
	需重新设计
	
5. 联系我们(contact us)
	css样式
	提交后操作？发送邮件还是。。。

6. 站内搜索
	如果支持站内搜索，要增加一个搜索结果页，目前无法分页。
	
7. 多语言支持

================
小组合作经验总结
================

1. 任务划分需尽量降低耦合度，以尽量减少多人同时修改导致的冲突。
具体做法：
	每个人负责部分的结构（php）、样式（css）、行为（js）首先分开在单独的文件里编写，最后再整合到一起，集中处理冲突。