<core.system id="system">
	<core.request id="request" />
	<core.rewrite.request matcher="host" matchMethod="equal" pattern="iweb.vn" 
			defaultQueryParams='{"app":"test", "controller": "Home", "action": "index"}' />
	<core.rewrite.request matcher="host" matchMethod="equal" pattern="qlhs.vn" 
			defaultQueryParams='{"app":"qlhs", "controller": "Student", "action": "index"}' />
	<core.rewrite.request matcher="host" matchMethod="equal" pattern="qlhs2.vn" 
			defaultQueryParams='{"app":"qlhs", "controller": "Student", "action": "index"}' />
	<core.rewrite.request matcher="host" matchMethod="equal" pattern="ptnn.vn" 
			defaultQueryParams='{"app":"ptnn", "controller": "Home", "action": "index"}' />
	<core.rewrite.request matcher="host" matchMethod="equal" pattern="vietthaibinh.com.vn" 
			defaultQueryParams='{"app":"travel", "controller": "Home", "action": "index"}' />
	<core.rewrite.request matcher="host" matchMethod="equal" pattern="phongthuy.vn" 
			defaultQueryParams='{"app":"phongthuy", "controller": "Home", "action": "index"}' />
	<core.rewrite.request matcher="host" matchMethod="equal" pattern="phongthuyhoangtra.vn" 
			defaultQueryParams='{"app":"phongthuy", "controller": "Home", "action": "index"}' />
	<core.rewrite.request matcher="host" matchMethod="equal" pattern="cms.vn" 
			defaultQueryParams='{"app":"cms", "controller": "Home", "action": "index"}' />
	<core.loader id="loader" />
	<core.storage name="filecache" timeout="9000" />
	<core.storage name="fileVar" timeout="9000" />
	<core.storage name="session" timeout="9000" />
	<!--core.storage name="memcache" timeout="900" /-->
	<core.language id="language" />
</core.system>