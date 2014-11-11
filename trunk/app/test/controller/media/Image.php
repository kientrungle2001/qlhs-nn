<?php
class PzkMediaImageController extends PzkController {
	public function uploadAction() {
		$request = pzk_element('request');
		$parentId = $request->getSegment(3);
		// include ImageManipulator class
		require_once(BASE_DIR . '/lib/ImageManipulator.php');
		
		foreach ($_FILES as $file) {
			// array of valid extensions
			$validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
			// get extension of the uploaded file
			$fileExtension = strrchr($file['name'], ".");
			// check if file Extension is on the list of allowed ones
			if (in_array($fileExtension, $validExtensions)) {
				$newNamePrefix = time() . '_';
				$manipulator = new ImageManipulator($file['tmp_name']);
				/*
				$width  = $manipulator->getWidth();
				$height = $manipulator->getHeight();
				$centreX = round($width / 2);
				$centreY = round($height / 2);
				// our dimensions will be 200x130
				$x1 = $centreX - 100; // 200 / 2
				$y1 = $centreY - 65; // 130 / 2
		 
				$x2 = $centreX + 100; // 200 / 2
				$y2 = $centreY + 65; // 130 / 2
		 
				// center cropping to 200x130
				$newImage = $manipulator->crop($x1, $y1, $x2, $y2);*/
				// saving file to uploads folder
				$fileName = '/uploads/' . $newNamePrefix . $file['name'];
				$manipulator->save(BASE_DIR . $fileName);
				$image = array(
					'type' => 'Media',
					'subType' => 'Image',
					'title' => $file['name'],
					'parentId' => $parentId,
					'dir' => BASE_DIR . $fileName,
					'src' => BASE_URL . $fileName
				);
				$image = _db()->buildInsertData('profile_resource', $image);
				$id = _db()->insert('profile_resource')->fields(implode(',', array_keys($image)))->values(array($image))->result();
				$image['id'] = $id;
				$image['src'] = BASE_URL . $fileName;
				unset($image['params']);
				echo json_encode(array('success' => true, 'fileName' => BASE_URL . $fileName, 'image' => $image));
			} else {
				echo json_encode(array('success' => false));
			}
		}
	}
	
	public function loadAction () {
		$request = pzk_element('request');
		$parentId = $request->getSegment(3);
		if($request->get('multiple')) {
			$images = _db()->select('*')->from('profile_resource')->where('type="Media" and subType="Image" and parentId=' . $parentId)->result();
			echo json_encode($images);
			return true;
		} else {
			$image = _db()->select('*')->from('profile_resource')->where('type="Media" and subType="Image" and parentId=' . $parentId)->result_one();
			unset($image['params']);
			unset($image['dir']);
			if($image) {
				echo json_encode(array(
					'image' => $image
				));
				return true;
			}
			echo 'false';
			return false;
		}
	}
	
	public function removeAction () {
		$request = pzk_element('request');
		$id = $request->getSegment(3);
		$row = _db()->select('*')->from('profile_resource')->where('id=' . $id)->result_one();
		unlink($row['dir']);
		_db()->treeDelete('profile_resource', $id);
		echo 'true';
		return true;
	}
}