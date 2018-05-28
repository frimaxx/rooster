/**
 * @api {post} /login Login
 * @apiVersion 1.0.0
 * @apiName Login
 * @apiGroup Auth
 *
 * @apiParam {String} username username or email of user
 * @apiParam {String} password password of user
 *
 * @apiSuccess {String} status success or error
 * @apiSuccess {Object}  data   User profile information.
 *
 * @apiSuccessExample Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "status": "success",
 *       "data": {
 *           "id": user.id,
 *           "username": user.username,
 *           "email": user.email,
 *           "api_token": user.api_token,
 *           "company" => {
 *              "id": company.id,
 *              "name": company.name,
 *              "city": company.city,
 *              "postal_code": company.postal_code,
 *              "address": company.address,
 *              "logo_url": company.logo,
 *              "base_64_logo": company.logo.base64
 *              "primary_color": company.primary_color,
 *              "seconday_color": company.seconday_color,
 *              "created_at": company.created_at,
 *              "updated_at": company.updated_at
 *           }
 *       }
 *     }
 *
 * @apiError Unauthorized Invalid username or password
 *
 * @apiErrorExample Error-Response:
 *     HTTP/1.1 403 Not Found
 *     {
 *       "status": "error",
 *       "message": "Invalid username or password"
 *     }
 */
