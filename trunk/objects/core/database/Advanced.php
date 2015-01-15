<?php
pzk_import('core.Database');
class PzkCoreDatabaseAdvanced extends PzkCoreDatabase {
	public function buildCondition($conds) {
		$builder = pzk_element('conditionBuilder');
		if($builder) {
			return $builder->build($conds);
		}
	}
}
