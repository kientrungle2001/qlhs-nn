<!--
	<core.rewrite.request pattern="\/home\/index\/template\/([*template*][\d]+)[\/]?$" route="/home/index" queryParams="template" />
	<core.rewrite.request pattern="\/region[\/]?$" route="/home/region" />
	<core.rewrite.request pattern="\/register[\/]?$" route="/home/register" />
	<core.rewrite.request pattern="\/product[\/]?$" route="/home/product" />
	<core.rewrite.request pattern="\/history[\/]?$" route="/home/history" />
	<core.rewrite.request pattern="\/service[\/]?$" route="/home/service" />
	<core.rewrite.request pattern="\/contact[\/]?$" route="/home/contact" />
	<core.rewrite.request pattern="\/directory[\/]?$" route="/home/directory" />
	<core.rewrite.request pattern="\/resource[\/]?$" route="/home/resource" />
	<core.rewrite.request pattern="\/profile[\/]?$" route="/home/profile" />
	<core.rewrite.request pattern="\/profile_resource[\/]?" route="/home/profile_resource" />
	<core.rewrite.request pattern="\/profileapps\/([*profileId*][\d]+)[\/]?$" route="/home/profileapps/$1" queryParams="profileId" />
	<core.rewrite.request pattern="\/profileapps\/([*profileId*][\d]+)\/([*profileAction*]create)[\/]?$" route="/home/profileapps/$profileId/$profileAction" queryParams="profileId, profileAction" />
	<core.rewrite.request pattern="\/profileapps\/([*profileId*][\d]+)\/([*appId*][\d]+)\/([*appAction*]delete)[\/]?$" route="/home/profileapps" queryParams="profileId, appId, appAction" />
	<core.rewrite.request pattern="^\/editapp\/([*appId*][\d]+)[\/]?$" route="/home/editapp/$appId" queryParams="appId" />
	<core.rewrite.request pattern="\/editapp\/([*appId*][\d]+)\/page\/([*pageId*][\d]+)[\/]?$" route="/home/editapp" queryParams="appId, pageId" />
	<core.rewrite.request pattern="\/editapp\/([*appId*][\d]+)\/page\/([*pageId*][\d]+)\/([*pageAction*]delete)[\/]?$" route="/home/editapp" queryParams="appId, pageId, pageAction"/>
	<core.rewrite.request pattern="\/editapp\/([*appId*][\d]+)\/page\/([*pageAction*]create)[\/]?$" route="/home/editapp" queryParams="appId, pageAction" />
	<core.rewrite.request pattern="\/editapp\/([*appId*][\d]+)\/page\/([*pageId*][\d]+)\/region\/([*regionId*][\d]+)[\/]?$" route="/home/editapp" queryParams="appId, pageId, regionId" />
	<core.rewrite.request pattern="\/editapp\/([*appId*][\d]+)\/page\/([*pageId*][\d]+)\/region\/([*regionId*][\d]+)\/([*regionAction*]delete)[\/]?$" route="/home/editapp" queryParams="appId, pageId, regionId, regionAction" />
	<core.rewrite.request pattern="\/editapp\/([*appId*][\d]+)\/page\/([*pageId*][\d]+)\/region\/([*regionAction*]create)[\/]?$" route="/home/editapp" queryParams="appId, pageId, regionAction" />
	<core.rewrite.request pattern="\/app\/([*appId*][\d]+)[\/]?$" route="/home/app" queryParams="appId" />
	<core.rewrite.request pattern="\/pageapp\/([*appId*][\d]+)\/([*pageId*][\d]+)[\/]?$" route="/home/pageapp" queryParams="appId, pageId" />
-->