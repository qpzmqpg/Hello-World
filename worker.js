// 引入必要的库
import { DurableObjectNamespace } from 'durable_objects';
import { DB } from '@cloudflare/durable_objects';

addEventListener('fetch', event => {
  event.respondWith(handleRequest(event.request));
});

async function handleRequest(request) {
  // 连接到 D1 数据库
  let db = new DB(DurableObjectNamespace, 'your-d1-database-id');

  // 查询数据库，例如列出所有表格
  let results = await db.query("PRAGMA table_list");

  // 构造 JSON 响应
  let jsonResult = JSON.stringify(results);

  // 返回 JSON 响应
  return new Response(jsonResult, {
    headers: {
      'Content-Type': 'application/json',
    },
  });
}
