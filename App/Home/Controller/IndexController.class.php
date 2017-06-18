<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
   
   /**
	 *
	 * Enter 导出excel共同方法 ...
	 * @param unknown_type $expTitle
	 * @param unknown_type $expCellName
	 * @param unknown_type $expTableData
	 */
	//实现导出exel功能
	public function exportExcel($expTitle,$expCellName,$expTableData){
		vendor("PHPExcel.PHPExcel"); //引用   phpexel 类
		$xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称   统一编码处理
		$fileName = $_SESSION['account'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
		$cellNum = count($expCellName);   //t统计表头数量
		$dataNum = count($expTableData);  //统计数据数量

		$objPHPExcel = new \PHPExcel();  //实例化phpexel类
		//设置exel 头部
		$cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

		$objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
		for($i=0;$i<$cellNum;$i++){
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
		}
		// Miscellaneous glyphs, UTF-8
		for($i=0;$i<$dataNum;$i++){
			for($j=0;$j<$cellNum;$j++){
				$objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
			}
		}
		//以下是告诉浏览器  这是一个xls 文件下载
		header('pragma:public');
		header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
		header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}

	/**
	 *
	 * 导出Excel
	 */
	function expUser(){
		//导出Excel
		$xlsName  = "User";  //设置名字
		//设置表头 一般是手写或者可以查询数据表数据字段   第一个参数用来关联查询的数据  第二个参数就是在表头显示的文字内容
		$xlsCell  = array(
		array('id','账号序列'),
		array('truename','名字'),
//		array('sex','性别'),
//		array('res_id','院系'),
//		array('sp_id','专业'),
//		array('class','班级'),
//		array('year','毕业时间'),
//		array('city','所在地'),
//		array('company','单位'),
//		array('zhicheng','职称'),
//		array('zhiwu','职务'),
//		array('jibie','级别'),
//		array('tel','电话'),
//		array('qq','qq'),
//		array('email','邮箱'),
//		array('honor','荣誉'),
//		array('remark','备注')
		);
		//$xlsModel = M('Member');
		//这里的数据一般是结合数据库直接查询出来
		$xlsData[0]['id'] ='4';
		$xlsData[0]['truename'] ='4';
		//$xlsData  = $xlsModel->Field('id,truename,sex,res_id,sp_id,class,year,city,company,zhicheng,zhiwu,jibie,tel,qq,email,honor,remark')->select();
//		foreach ($xlsData as $k => $v)
//		{
//			$xlsData[$k]['sex']=$v['sex']==1?'男':'女';
//		}
		//调用方法
		$this->exportExcel($xlsName,$xlsCell,$xlsData);
			
	}
	/**
	 *
	 * 显示导入页面 ...
	 */

	/**实现导入excel
	 **/
   function impUser(){
		if (!empty($_FILES)) {
			//首先将文件存入空间  方便下面读取
			$config=array(
                'exts'=>array('xlsx','xls'),
                'rootPath'=>"./Public/",
                'savePath'=>'Uploads/',
                'subName'    =>    array('date','Ymd'),
			);
			//实例化内置上传内 并 保存文件
			$upload = new \Think\Upload($config);
            if (!$info=$upload->upload()) {
                $this->error($upload->getError());
			}else {
				$info = $upload->getUploadFileInfo();
			}
            //实例化phpexel 并读取内容
			vendor("PHPExcel.PHPExcel");
			$file_name=$upload->rootPath.$info['import']['savepath'].$info['import']['savename'];
            $objReader = \PHPExcel_IOFactory::createReader('Excel5');
			$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
			$sheet = $objPHPExcel->getSheet(0);  //默认取得sheet1
			$highestRow = $sheet->getHighestRow(); // 取得总行数
			$highestColumn = $sheet->getHighestColumn(); // 取得总列数
			//循环每行数据  并读取改数据 并且保存到数据库
			for($i=3;$i<=$highestRow;$i++)
			{
				$data['account']= $data['truename'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
				$sex = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
				$data['class'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
				$data['year'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
				$data['city']= $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
				$data['company']= $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
				$data['zhicheng']= $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
				$data['zhiwu']= $objPHPExcel->getActiveSheet()->getCell("J".$i)->getValue();
				$data['jibie']= $objPHPExcel->getActiveSheet()->getCell("K".$i)->getValue();
				$data['honor']= $objPHPExcel->getActiveSheet()->getCell("L".$i)->getValue();
				$data['tel']= $objPHPExcel->getActiveSheet()->getCell("M".$i)->getValue();
				$data['qq']= $objPHPExcel->getActiveSheet()->getCell("N".$i)->getValue();
				$data['email']= $objPHPExcel->getActiveSheet()->getCell("O".$i)->getValue();
				$data['remark']= $objPHPExcel->getActiveSheet()->getCell("P".$i)->getValue();
				$data['sex']=$sex=='男'?1:0;
				$data['res_id'] =1;
				$data['last_login_time']=0;
				$data['create_time']=$data['last_login_ip']=$_SERVER['REMOTE_ADDR'];
				$data['login_count']=0;
				$data['join']=0;
				$data['avatar']='';
				$data['password']=md5('123456');
				//存入数据库

			}
			$this->success('导入成功！');
		}else
		{
			$this->error("请选择上传的文件");
		}
	}

  


}