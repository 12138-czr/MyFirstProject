<?php
namespace app\admin\controller;
use think\Controller;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Request;

class Content extends Base {

    #博客分类
    public function category(){
        $list = db('category')->order('sort')->select();

        $zNodes = '';

        foreach ($list as $v){
            $open = $v['parent_id']==0?',open:true':',open:false';
            $zNodes .= '{ id:'.$v['id'].', pId:'.$v['parent_id'].', name:"'.$v['name'].'"'.$open.',url:"'.url('category_add',['id'=>$v['id']]).'",target:"testIframe"},';
        }

        $this->assign('zNodes',$zNodes);

        return $this->fetch();
    }
    public function category_add(){
        $db = db('category');
        if (request()->isPost()){
            $data = input('post.');
            $data['sort'] = !empty($data['sort'])?intval($data['sort']):0;
            if (empty($data['name'])){
                echo '必须填写分类名称';die;
            }

            $b = $db->insert($data);
            if ($b){
                echo 1;
            }else{
                echo '操作失败';
            }

        }else{
            $id = input('id',0);
            if ($id > 0){
                try {
                    $row = $db->find($id);
                } catch (DataNotFoundException $e) {
                } catch (ModelNotFoundException $e) {
                } catch (DbException $e) {
                }
            }else{
                $row = ['sort'=>0,'is_show'=>1];
            }
            $category = $db->order('sort')->select();
            $category = category_merge($category);

            $this->assign('row',$row);
            $this->assign('category',$category);
            return $this->fetch();
        }
    }

    public function article_list(){
        echo '博客列表';
    }



}