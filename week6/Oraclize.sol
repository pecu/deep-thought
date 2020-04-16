import "https://github.com/provable-things/ethereum-api/blob/master/oraclizeAPI_0.5.sol";

pragma solidity ^0.5.17;

contract SimpleOraclizeContract is usingOraclize {

    string public randomNum; 
    event LogConstructorInitiated(string nextStep);
    event LogPriceUpdated(string price);
    event LogNewOraclizeQuery(string description);

    constructor() public payable {
        emit LogConstructorInitiated("Constructor was initiated. Call 'updatePrice()' to send the Oraclize Query.");
    }

    function __callback(bytes32 myid, string memory result) public {
        if (msg.sender != oraclize_cbAddress()) revert();
        randomNum = result;
        emit LogPriceUpdated(result);
    }

    function updateNum() public payable {
        if (oraclize_getPrice("URL") > address(this).balance) {
            emit LogNewOraclizeQuery("Oraclize query was NOT sent, please add some ETH to cover for the query fee");
        } else {
            emit LogNewOraclizeQuery("Oraclize query was sent, standing by for the answer..");
            oraclize_query("URL", "json(API_URL)");
        }
    }
}



