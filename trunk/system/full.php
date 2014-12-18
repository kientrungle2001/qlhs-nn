<core.system id="system">
	<core.loader id="loader" />
	<core.request id="request" />
	<core.rewrite.host name="iweb.vn" app="test" />
	<core.rewrite.host name="qlhs.vn" app="qlhs" controller="Student" action="index" />
	<core.rewrite.host name="ptnn.vn" app="ptnn" />
	<core.rewrite.host name="vietthaibinh.com.vn" app="travel" />
	<core.rewrite.host name="phongthuy.vn" app="phongthuy" />
	<core.rewrite.host name="phongthuyhoangtra.vn" app="phongthuy" />
	<core.rewrite.host name="cms.vn" app="cms" />
	<core.storage name="filecache" timeout="9000" />
	<core.storage name="fileVar" timeout="9000" />
	<core.storage name="session" timeout="9000" />
	<!--core.storage name="memcache" timeout="900" /-->
	<core.language id="language" />
</core.system>