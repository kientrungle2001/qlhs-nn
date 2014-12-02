<div>
<easyui.grid.tree url="/admin_home/categoryJSON" id="tree" idField="id" parentField="parent" onClick="function(node) {alert(node.text);}">
</easyui.grid.tree>
<core.db.tree id="category" rootId="" table="categories" layout="admin/home/category" />
</div>