#Imagina View Count

Module that gives site visitors and site owners the ability to quickly and easily see how many people have visited that page, post or product.

##Api Routes

view all counts

```
https://mydomine.com/api/counts?take=12&page=1
```
view all counts Order by entity

```
https://mydomine.com/api/counts??filter={"order":{"field":"entity","way":"asc"}}&take=12&page=1
```

store count by item

```
POST
https://mydomine.com/api/counts
```
values json to seed
```$xslt
{
"atributes":{
    "entity":post, //post,page,product or event
    "entity_id:1 //entity's id
}
```