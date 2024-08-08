from js import Response

async def on_fetch(request, env):
    # 查询 D1 数据库的例子，例如列出数据库中所有表
    results = await env.DB.prepare("PRAGMA table_list").all()
    # 返回一个 JSON 响应
    return Response.json(results)
