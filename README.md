# About Features 

- 实现某个目录的自动加载，与 PSR-4 规则一致

	- event                     `` ( 事件系统的主体 )``  
		+ Utility               `` ( 事件系统辅助的类库) ``
		+ ..
	- tracker					`` ( 事件系统追溯线 ) `` 
	- config                    `` ( 事件系统的行为配置 )`` 
	- logs						`` ( 事件系统产生的日志数据 )`` 

### 事件系统的由来

在现代 Web应用系统当中，经常存在某个业务所产生的数据需要**``“贯穿”``**整个Web 系统/API 使用， 多可用于数据的收集，监控，分发等等， 并与其它的系统的相关关联（例如构建一条调用链，来控制系统的其他功能）

### 事件系统的工作原理

与 MVC框架类似，存在一个入口点（这里指事件触发点），
然后交给不同的分发器来分发，分发器发送至不同的处理层，最后完成事件的接收处理和使用