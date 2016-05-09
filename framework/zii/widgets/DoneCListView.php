<?php

Yii::import('zii.widgets.CListView');
class DoneCListView extends CListView{
public function renderItems()
	{
            
		echo CHtml::openTag($this->itemsTagName,array('class'=>$this->itemsCssClass))."\n";
		$data=$this->dataProvider->getData();
		if(($n=count($data))>0)
		{
			$owner=$this->getOwner();
			$viewFile=$owner->getViewFile($this->itemView);
			$j=0;
                        
                        $order_id;//Міститиме в собі номер замовлення для групування по замовленнях
                        
			foreach($data as $i=>$item)
			{
                            //перевіряємо чи це перший елемент і виводимо початок блоку
                            if (!$order_id){
                                echo '<div class="view_order done_list"> ';
                                echo '<div class="done_product" >';
                                echo '<div class="order_id" > Номер замовлення: '.$item->order_id.'</div>';
                               $product = Done::model()->with('product')->findByPk($item->order_id);
                               $product_quantity = Done::model()->with('archiveproduct')->findByPk($item->order_id);
                               foreach ($product_quantity->archiveproduct as $one){
                                   $quantity = $one->quantity;
                               }
                               foreach ($product->product as $one){
                                  $name_product = $one->name;
                                
                                }
                                
                                echo '<div class="title_order" > Продукт, що був виготовлений: '.$name_product.'</div>';
                                echo '<div class="title_order" > Кількість: '.$quantity.'</div>';
                                echo '</div>';
                                
                                
                            } else {
                                $oreder_id_next = $item->order_id; //задаємо параметр для перевірки минулого номеру замовлення з теперішнім
                            }
                            //якщо не збігається розбиваємо на блоку та виводимо необхідну інформацію
                            if ($order_id != $oreder_id_next ){
                                echo '</div>';
                                echo '<div class="view_order done_list" >';
                                echo '<div class="done_product" >';
                                echo '<div class="order_id" > Номер замовлення: '.$item->order_id.'</div>';
                                
                                $product = Done::model()->with('product')->findByPk($item->order_id); 
                                foreach ($product->product as $one){
                                  $name_product = $one->name;
                                }
                                $product_quantity = Done::model()->with('archiveproduct')->findByPk($item->order_id);
                                foreach ($product_quantity->archiveproduct as $one){
                                    $quantity = $one->quantity;
                                }
                                
                                
                                echo '<div class="title_order" > Продукт, що був виготовлений: '.$name_product.'</div>';
                                echo '<div class="title_order" > Кількість: '.$quantity.'</div>';
                                echo '</div>';
                            }
                                
                                $order_id=$item->order_id;
                                
                                
				$data=$this->viewData;
				$data['index']=$i;
				$data['data']=$item;
				$data['widget']=$this;
				$owner->renderFile($viewFile,$data);
				if($j++ < $n-1)
					echo $this->separator;
			}
		}
		else
			$this->renderEmptyText();
		echo CHtml::closeTag($this->itemsTagName);
                echo'</div>';
	}
}

