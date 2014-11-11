	<core.rewrite.request pattern="\/ide_app\/list\/([*profileId*][\d]+)" queryParams="profileId" />
	<core.rewrite.request pattern="\/ide_app\/edit\/([*appId*][\d]+)" queryParams="appId" />
	<core.rewrite.request pattern="\/page\/([*pageId*][\d]+)[-\w\d_]*$" route="/ide_app_page/preview/$pageId" />