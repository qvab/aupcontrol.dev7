<?php
/**
 * Created by PhpStorm.
 * User: m.mishanin
 * Date: 30.01.2020
 * Time: 16:21
 */

namespace MIWR;
require_once $_SERVER["DOCUMENT_ROOT"] . "/local/classes_miwr/__core.php";

class MWTokens extends __core
{

  private $table = "users_token";
  private $obGetList;

  public function getList($arParam = false)
  {
    $arParam = $this->__options([
      "table" => $this->table
    ], $arParam);
    return $this->obGetList = $this->__dbGet($arParam);
  }

  public function get($mixSearchData)
  {
    $arParam = $this->__options([
      "table" => $this->table
    ], [
      "limit" => "LIMIT 1",
      "where" => "WHERE bx_user_id = '{$mixSearchData}'",
      "pagination" => false
    ]);
    return $this->__fetch($this->__dbGet($arParam));
  }


  public function addAccount($sSubDomain, $sLogin, $sHash)
  {
    $arAccount = $this->get($sSubDomain);
    if (!empty($arAccount)) {
      return $arAccount;
    } else {
      $this->insert([
        "subdomain" => $sSubDomain,
        "login" => $sLogin,
        "hash" => $sHash
      ]);
      $arAccount = $this->get($sSubDomain);
      return $arAccount;
    }
  }

  public function dbQuery($sSql)
  {
    $this->__dbConnect();
    return $this->obGetList = $this->__dbQuery($sSql);
  }


  public function getById($id)
  {
    $arParam = $this->__options([
      "table" => $this->table
    ], [
      "limit" => "LIMIT 1",
      "where" => "WHERE id = '{$id}'",
      "pagination" => false
    ]);
    return $this->__fetch($this->__dbGet($arParam));
  }


  public function fetch()
  {
    return $this->__fetch($this->obGetList);
  }

  public function getCount($sWhere = "")
  {
    $this->__dbGet([
      "table" => $this->table,
      "select" => "count(id) as count",
      "limit" => "",
      "where" => $sWhere ? "WHERE " . $sWhere : ""
    ]);
    return $this->fetch()["count"];
  }

  public function getMax($sField, $sWhere = false)
  {
    if (!empty($sField)) {
      $this->__dbGet([
        "table" => $this->table,
        "select" => "max(" . $sField . ") as max",
        "limit" => "",
        "where" => $sWhere ? "WHERE " . $sWhere : ""
      ]);
      return $this->fetch()["max"];
    } else {
      $this->errors[$this->table]["getMax"] = '$sField is NULL';
    }
    return false;
  }

  public function getDist($sFiled = "")
  {
    $this->__dbGet([
      "table" => $this->table,
      "select" => "DISTINCT " . $sFiled,
      "limit" => "",
    ]);
  }

  public function update($set, $id = false, $sWhere = false)
  {
    $response = $this->__dbUpdate([
      "table" => $this->table,
      "set" => $set,
      "where" => !empty($id) ? "WHERE id = '{$id}'" : $sWhere
    ]);
    return $response;
  }

  public function clear()
  {
    return $this->__dbDelete("clear_at < ".time(), $this->table);
  }

  public function insert($arFields)
  {
    $res = $this->__dbInsert([
      "table" => $this->table,
      "fields" => $arFields
    ], true);
    return $res;
  }


}