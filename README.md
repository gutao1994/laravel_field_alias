在financial中存在着字段的映射关系

############################

setRawAttributes(array $attributes, $sync = false)

在该方法中设置了 模型在获取到数据时进行的操作，将字段映射成已经定义好的对应字段

这样，在通过$model['serial_number']获取值时，就能够获取到$model['number']的值
            $model->serial_number                        $model->number
----------------------------

setAttribute($key, $value)

在该方法中设置了 模型保存或者更新数据时的做的字段映射(create save)

当 $model->serial_number = 'xxx' 时，相当于 $model->number = 'xxx' 操作

----------------------------

__call($method, $parameters)

当进行where(whereIn whereBetween...)查询的时候
['serial_number', 'xxxx']     ====>  ['number', 'xxxx']
['serial_number', ['a', 'b']  ====>  ['number', ['a', 'b']]


当进行批量插入(Model::insert)的时候(与create不同...)
[
  [
    'serial_number' => 'xxx',
    'sign_time' => '0000-00-00'
  ],
  [
    'serial_number' => 'yyy',
    'sign_time' => '1111-11-11'
  ],
  ...
]

转变成对应的映射字段

[
  [
    'number' => 'xxx',
    'buy_date' => '0000-00-00'
  ],
  [
    'number' => 'yyy',
    'buy_date' => '1111-11-11'
  ],
  ...
]

############################

之所以要进行上面的那些转换，是因为数据表对应的字段名称改变了
原先 serial_number 变成了 number
     sign_time            buy_date
     .....

为了不改写更多的业务代码，从而使用了如上方法，使得字段的改动对于业务代码来说是透明的


另外对于一些改变了的字段如果存在于left join、inner join 查询里面做where 查询，那么上面的
映射关系就起不了作用了
所以最好在查询之前对字段做相应的更改

