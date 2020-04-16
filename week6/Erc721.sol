pragma solidity ^0.6.0;

library SafeMath {
    function add(uint a, uint b) internal pure returns (uint c) {
        c = a + b;
        require(c >= a);
    }
    function sub(uint a, uint b) internal pure returns (uint c) {
        require(b <= a);
        c = a - b;
    }
    function mul(uint a, uint b) internal pure returns (uint c) {
        c = a * b;
        require(a == 0 || c / a == b);
    }
    function div(uint a, uint b) internal pure returns (uint c) {
        require(b > 0);
        c = a / b;
    }
}

library Address {
    function isContract(address account) internal view returns (bool) {
        bytes32 codehash;
        bytes32 accountHash = 0xc5d2460186f7233c927e7db2dcc703c0e500b653ca82273b7bfad8045d85a470;
        assembly { codehash := extcodehash(account) }
        return (codehash != accountHash && codehash != 0x0);
    }

    function sendValue(address payable recipient, uint256 amount) internal {
        require(address(this).balance >= amount, "Address: insufficient balance");
        (bool success, ) = recipient.call.value(amount)("");
        require(success, "Address: unable to send value, recipient may have reverted");
    }
}

contract Owned {
    address payable public owner;
    address payable public newOwner;
 
    event OwnershipTransferred(address indexed _from, address indexed _to);
 
    constructor() public {
        owner = msg.sender;
    }
 
    modifier onlyOwner {
        require(msg.sender == owner);
        _;
    }
 
    function transferOwnership(address payable _newOwner) public onlyOwner {
        newOwner = _newOwner;
    }
    
    function acceptOwnership() public {
        require(msg.sender == newOwner);
        emit OwnershipTransferred(owner, newOwner);
        owner = newOwner;
        newOwner = address(0);
    }
}

interface IERC165 {
    function supportsInterface(bytes4 interfaceId) external view returns (bool);
}

interface IERC721 {
    event Transfer(address indexed from, address indexed to, uint256 indexed tokenId);
    event Approval(address indexed owner, address indexed approved, uint256 indexed tokenId);
    event ApprovalForAll(address indexed owner, address indexed operator, bool approved);

    function balanceOf(address owner) external view returns (uint256 balance);
    function ownerOf(uint256 tokenId) external view returns (address owner);
    function safeTransferFrom(address from, address to, uint256 tokenId) external;
    function transferFrom(address from, address to, uint256 tokenId) external;
    function approve(address to, uint256 tokenId) external;
    function getApproved(uint256 tokenId) external view returns (address operator);
    function setApprovalForAll(address operator, bool _approved) external;
    function isApprovedForAll(address owner, address operator) external view returns (bool);
    function safeTransferFrom(address from, address to, uint256 tokenId, bytes calldata data) external;
}

abstract contract IERC721Receiver {
    function onERC721Received(address operator, address from, uint256 tokenId, bytes memory data)
    public virtual returns (bytes4);
}

contract ERC721 is IERC165, IERC721 {
    using SafeMath for uint256; 
    using Address for address; 
    
    mapping (uint256 => address) idToOwner;
    mapping (uint256 => address) idToApproval;
    mapping (address => uint256) ownerToNFTokenCount;
    mapping (address => mapping (address => bool)) internal ownerToOperators;
    mapping (bytes4 => bool) supportedInterfaces;
    
    constructor() public {
        supportedInterfaces[0x01ffc9a7] = true; // ERC165
        supportedInterfaces[0x80ac58cd] = true; // ERC721
    }
    
    function supportsInterface(bytes4 interfaceId) external override view returns (bool) {
        return supportedInterfaces[interfaceId];
    }
    
    function balanceOf(address owner) external override view returns (uint256) {
        require(owner != address(0), "ERC721: balance query for the zero address");
        return ownerToNFTokenCount[owner];
    } 
    
    function ownerOf(uint256 tokenId) external override view returns (address) {
        require(idToOwner[tokenId] != address(0), "Not valid NFT");
        return idToOwner[tokenId];
    } 
    
    function safeTransferFrom(address from, address to, uint256 tokenId) external override {
        address tokenOwner = idToOwner[tokenId];
        
        require(tokenOwner == from, "Not owner");
        require(to != address(0), "Zero address");
    
        _transfer(to, tokenId);
    
        if (to.isContract())
        {
          bytes4 retval = IERC721Receiver(to).onERC721Received(msg.sender, from, tokenId, "");
          require(retval == 0x150b7a02, "Not able to receive NFT");
        }
    } 
    
    function safeTransferFrom(address from, address to, uint256 tokenId, bytes calldata data) external override {
        address tokenOwner = idToOwner[tokenId];
        
        require(tokenOwner == from, "Not owner");
        require(to != address(0), "Zero address");
    
        _transfer(to, tokenId);
    
        if (to.isContract())
        {
        //If to is contract address, trigger onERC721Received function
          bytes4 retval = IERC721Receiver(to).onERC721Received(msg.sender, from, tokenId, data); 
          require(retval == 0x150b7a02, "Not able to receive NFT");
        }
    }
    
    function transferFrom(address from, address to, uint256 tokenId) external override {
        address tokenOwner = idToOwner[tokenId];
        
        require(tokenOwner == from, "Not owner");
        require(to != address(0), "Zero address");
    
        _transfer(to, tokenId);
    }
    
    function approve(address to, uint256 tokenId) external override {
        address tokenOwner = idToOwner[tokenId];
        require(to != tokenOwner, "Is owner");
    
        idToApproval[tokenId] = to;
        emit Approval(tokenOwner, to, tokenId);
    }
    
    function getApproved(uint256 tokenId) external override view returns (address) {
        return idToApproval[tokenId];
    }
    
    function setApprovalForAll(address operator, bool approved) external override {
        ownerToOperators[msg.sender][operator] = approved;
        emit ApprovalForAll(msg.sender, operator, approved);
    }
    
    function isApprovedForAll(address owner, address operator) external override view returns (bool) {
        return ownerToOperators[owner][operator];
    }
    
    // _function is additional function
    function _transfer(address to, uint256 tokenId) internal {
        address from = idToOwner[tokenId];
        
        _clearApproval(tokenId);
        _removeNFToken(from, tokenId);
        _addNFToken(to, tokenId);
    
        emit Transfer(from, to, tokenId);
    }
    
    function _clearApproval(uint256 _tokenId) private {
        if (idToApproval[_tokenId] != address(0))
        {
            delete idToApproval[_tokenId];
        }
    }
    
    function _removeNFToken(address _from, uint256 _tokenId) internal virtual {
        require(idToOwner[_tokenId] == _from, "Not owner");
        
        ownerToNFTokenCount[_from] = ownerToNFTokenCount[_from].sub(1);
        delete idToOwner[_tokenId];
    }
    
    function _addNFToken(address _to, uint256 _tokenId) internal virtual {
        require(idToOwner[_tokenId] == address(0), "NFT already exist");

        idToOwner[_tokenId] = _to;
        ownerToNFTokenCount[_to] = ownerToNFTokenCount[_to].add(1);
    }
    
}

contract Boyfriend is ERC721{
    struct boyfriend {
        uint8 hightLevel;
        uint8 richLevel;
        uint8 handsomeLevel;
    }
    
    boyfriend[] boyfriendArr;
    
    function random() private view returns(uint256){
         bytes32 randomNum = keccak256(abi.encodePacked(block.timestamp, blockhash(block.number), msg.sender));
         return uint256(randomNum);
    }
    
    function generateBoyfriend() payable public {
        require(msg.value == 0.5 ether, "Ether is less than 0.5");
        
        uint256 randomNum = random();
        uint8 richLevel = uint8(randomNum % 10);
        uint8 handsomeLevel = uint8(randomNum.div(100) % 10);
        uint8 hightLevel = 165 + uint8(randomNum.div(10000) % 20);
        uint tokenId;
        
        boyfriendArr.push(boyfriend(hightLevel, richLevel, handsomeLevel));
        tokenId = boyfriendArr.length - 1;
        idToOwner[tokenId] = msg.sender;
        ownerToNFTokenCount[msg.sender] += 1;
    }
}


